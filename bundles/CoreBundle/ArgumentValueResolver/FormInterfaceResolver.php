<?php

declare(strict_types=1);

namespace PhatKoala\CoreBundle\ArgumentValueResolver;

use PhatKoala\CoreBundle\Annotation\Form;
use Generator;
use InvalidArgumentException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use function sprintf;

class FormInterfaceResolver implements ArgumentValueResolverInterface
{
    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $type = $argument->getType();
        if (!$type) {
            return false;
        }

        return FormInterface::class === $type;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        /** @var Form|null $annotation */
        $annotation = $request->attributes->get('_form');
        if (!$annotation) {
            throw new InvalidArgumentException(sprintf('You must provide "%s" annotation to resolve typehinted FormInterface.', Form::class));
        }
        $class = $annotation->class;

        $dataParameter = $annotation->data;
        if ($dataParameter && !$request->attributes->has($dataParameter)) {
            throw new InvalidArgumentException(sprintf('Missing parameter "%s" in method signature.', $dataParameter));
        }
        /** @var object|null $data */
        $data = $dataParameter ? $request->attributes->get($dataParameter) : null;

        $options = (array) $annotation->options;

        $form = $this->formFactory->create($class, $data, $options);
        $form->handleRequest($request);

        yield $form;
    }
}
