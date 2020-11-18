;(function ($) {
  console.log('homepage')
  console.log(FWP)

  $(document).on('facetwp-loaded', function () {
    if ('undefined' !== typeof FWP) {
      FWP.auto_refresh = false
    }
    modifyHomeFSelectFacet()
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

  function modifyHomeFSelectFacet() {
    console.log('hi')
    $('.home__inline-filters .facetwp-type-fselect').each(
      function () {
        const $facet = $(this)
        const facet_name = $facet.attr('data-name')
        const facet_label = FWP.settings.labels[facet_name]

        // Add Number of Selected Options to Wrapper
        const numSelected = FWP.facets[facet_name].length
        this.querySelector('.fs-label-wrap').setAttribute(
          'data-num',
          numSelected
        )

        // If these fields already exist, don't create them again.
        if (this.querySelector('.fs-label-field')) {
          return
        }

        // Add Facet Label
        const label = document.createElement('div')
        label.classList.add('fs-label-field')
        label.innerHTML = facet_label

        this.querySelector('.fs-label-wrap').prepend(label)
      }
    )
  }
})(jQuery)
