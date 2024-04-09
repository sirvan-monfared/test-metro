const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/components/**/*.vue",
        "./app/Kodesign/helpers.php",
        "./app/Enums/*.php",
    ],
    safelist: ["h-auto", "border-r-blue-500", "border-r-green-600", "border-r-rose-500"],

    theme: {
        extend: {
            fontFamily: {
                sans: ["IRANSans"],
            },
            colors: {
                gray: {
                    800: "#333333",
                    900: "#454545",
                },
                blueGray: {
                    600: "#365164",
                },
                lightBlue: {
                    600: "#0369a1",
                },
            },
            fontSize: {
                xxs: ["0.625rem", "1"],
            },
            borderWidth: {
                3: "3px",
            },
            boxShadow: {
                md: "0 0 16px rgba(0,0,0,0.1)",
                blogItem:
                    "0 .332071px 1.57734px rgba(0,0,0,.0562291),0 .798012px 3.79056px rgba(0,0,0,.0807786),0 1.50259px 7.13728px rgba(0,0,0,.1),0 2.68036px 12.7317px rgba(0,0,0,.119221),0 5.01331px 23.8132px rgba(0,0,0,.143771),0 12px 57px rgba(0,0,0,.2);",
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require('@tailwindcss/line-clamp')
    ],
};
