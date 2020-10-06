/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */

module.exports = {
  // Project options.
  projectURL: 'https://energy-jti.local', // Local project URL of your already running WordPress site. Could be something like wpgulp.local or localhost:3000 depending upon your local WordPress setup.
  productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
  browserAutoOpen: true,
  injectChanges: true,

  // Style options.
  styleSRC: './assets/_scss/**/*.scss', // Path to .scss files.
  styleSRCDir: './assets/_scss/', // Path to .scss src directory.
  styleDestination: './assets/css/', // Path to place the compiled CSS file. Default set to root folder.
  mainStyleDestination: './', // Root directory for WordPress requirements.
  outputStyle: 'compressed', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
  errLogToConsole: true,
  precision: 10,

  // JS Vendor options.
  jsVendorSRC: './assets/_js/vendor/*.js', // Path to JS vendor folder.
  jsVendorDestination: './assets/js/', // Path to place the compiled JS vendors file.
  jsVendorFile: 'vendor', // Compiled JS vendors file name. Default set to vendors i.e. vendors.js.

  // JS Custom options.
  jsCustomSRC: './assets/_js/custom/*.js', // Path to JS custom scripts folder.
  jsCustomDestination: './assets/js/', // Path to place the compiled JS custom scripts file.
  jsCustomFile: 'custom', // Compiled JS custom file name. Default set to custom i.e. custom.js.

  // Images options.
  imgSRC: './assets/_images/**/*', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
  imgDST: './assets/images/', // Destination folder of optimized images. Must be different from the imagesSRC folder.

  // Watch files paths.
  watchStyles: './assets/_scss/**/*.scss', // Path to all *.scss files inside css folder and inside them.
  watchJsVendor: './assets/_js/vendor/*.js', // Path to all vendor JS files.
  watchJsCustom: './assets/_js/custom/*.js', // Path to all custom JS files.
  watchPhp: './**/*.php', // Path to all PHP files.

  // Translation options.
  textDomain: 'csisjti', // Your textdomain here.
  translationFile: 'csisjti.pot', // Name of the translation file.
  translationDestination: './languages', // Where to save the translation files.
  packageName: 'CSIS iLab', // Package name.
  bugReport: 'https://github.com/CSIS-iLab/energy-jti', // Where can users report bugs.
  lastTranslator: 'CSIS iDeas Lab <csisideaslab@email.com>', // Last translator Email ID.
  team: 'CSIS iDeas Lab <csisideaslab@email.com>', // Team's Email ID.

  // Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
  // The following list is set as per WordPress requirements. Though, Feel free to change.
  BROWSERS_LIST: ['defaults'],
}
