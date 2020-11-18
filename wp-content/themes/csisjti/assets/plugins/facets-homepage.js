;(function ($) {
  console.log('homepage')
  console.log(FWP)

  $(document).on('facetwp-loaded', function () {
    if ('undefined' !== typeof FWP) {
      FWP.auto_refresh = false
    }
  })

  $(document).on('click', '.fwp-submit', function () {
    FWP.parse_facets()

    var href = $(this).attr('data-href')
    var query_string = FWP.build_query_string()

    if (query_string.length) {
      var prefix = -1 < href.indexOf('?') ? '&' : '?'
      href += prefix + query_string
    }

    window.location.href = href
  })
})(jQuery)
