const { colors } = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        extend: {
            colors: {
                primary: colors.indigo,
                secondary: colors.gray,
                success: colors.green,
                danger: colors.red,
                warning: colors.yellow,
                info: colors.blue,
            }
        }
    }
}