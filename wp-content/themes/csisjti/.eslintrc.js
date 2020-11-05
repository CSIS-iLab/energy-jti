module.exports = {
  env: {
    browser: true,
    commonjs: true,
    es6: true,
    node: true,
  },
  extends: ['eslint:recommended', 'prettier', 'plugin:prettier/recommended'],
  parserOptions: {
    sourceType: 'module',
  },
  rules: {
    'linebreak-style': ['error', 'unix'],
    quotes: ['error', 'single'],
    'no-console': 0,
    'no-debugger': 'warn',
		'no-var': 'warn',
		'no-unused-vars': 'warn',
    'require-jsdoc': 'off',
  },
}
