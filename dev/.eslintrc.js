module.exports = {
    "env": {
        "browser": true,
        "commonjs": true
    },
//    "extends": "eslint:recommended",
    "extends": ['eslint:recommended', 'vue', 'plugin:vue/recommended'],
    "parserOptions": {
        "ecmaVersion": 5
    },
    "rules": {
        "indent": [
            "error",
            4
        ],
        "linebreak-style": [
            "error",
            "unix"
        ],
        "quotes": [
            "error",
            "single"
        ],
        "semi": [
            "error",
            "always"
        ],
        "no-console": ["error", { allow: ["warn", "error"] }]
    }
};