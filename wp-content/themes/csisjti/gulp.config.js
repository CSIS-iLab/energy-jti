module.exports = {
  // Project options.
  projectURL: 'https://energy-jti.local', // Local project URL of your already running WordPress site. Could be something like wpgulp.local or localhost:3000 depending upon your local WordPress setup.
  productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
  browserAutoOpen: true,
  injectChanges: true,
  assets: './assets/',
  src: './src',
  dest: './dist',
  php: './**/*.php',
  pluginsJS: './assets/plugins/**/*.js',
  import: 'tippy.js/dist/tippy.css', 

  port: 8080,

  eslintLoader: {
    enforce: 'pre',
    test: /\.js$/,
    exclude: /node_modules/,
    loader: 'eslint-loader',
  },

  imagemin: {
    src: '_img',
    dest: 'img',
    svgoPlugins: [{ removeViewBox: false }],
    mozjpeg: {
      quality: 85,
      progressive: true,
    },
    optipng: {
      optimizationLevel: 5,
      interlaced: null,
    },
  },

  js: {
    src: '_js',
    dest: 'js',
    entry: [
      'vendor/vendor.js',
      'vendor/skip-link-focus-fix.js',
      'custom/bundle.js',
      'custom/resource-library.js',
    ],
  },

  sass: {
    src: '_scss',
    dest: 'css',
    outputStyle: 'compressed',
    autoprefixer: {
      grid: true,
    },
    mainStyleSheetDest: './',
  },

  webpack: {
    mode: 'production',
    module: {
      rules: [
        {
        test: /\.css$/i,
        use: ["style-loader", "css-loader"],
        }
      ],
    },
    // optimization: {
    //   splitChunks: {
    //     chunks: 'all',
    //   },
    // },
    externalsType: 'script',
    externals: {
      tippy: ['https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js',
      'https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js']
      }
  },
}
