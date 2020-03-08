*Things to do*
- install doctrine extensions
- authentication
- Rename PostType to PostForm
- Create PostFilter
- Forms need to be in "Post" namespace
- How to expose API? Security.

No front end.  Expose "content" via an API

*CMS* 
- /cms/{type}
- index | edit | new

*Taxonomy* 
- /taxonomy/{type}
- index | edit | new

*User*
- /user/{type}

*Demographic*
- /demographic/{type}

Normalise properties,
- Hierarchical - isHierarchical / setHierachical
- Public - isPublic / setPublic

Think Members Lounge.
- Do I need a "front end".
- How to display navigation menus.
- Do I try and separate "Admin" and "User" functionality...
- One demographic must be able to live inside another


Permissions
- Need permissions on a post tyep
- Then specific permissions on posts

Install a theme that implements a "front controller"