/* eslint no-undef: 0 */

;(function ($) {
  $(document).on('facetwp-loaded', function () {
    modifyFSelectFacet()

    console.log('hello! world')
  })

  function modifyFSelectFacet() {
    $('.facetwp-type-fselect').each(function () {
      const $facet = $(this)
      const facet_name = $facet.attr('data-name')
      const facet_label = FWP.settings.labels[facet_name]

      // Add Facet Label
      const label = document.createElement('div')
      label.classList.add('fs-label-field')
      label.innerHTML = facet_label

      this.querySelector('.fs-label-wrap').prepend(label)

      // Add Number of Selected Options to Wrapper
      const numSelected = FWP.facets[facet_name].length
      this.querySelector('.fs-label-wrap').setAttribute('data-num', numSelected)
    })
  }
})(jQuery)
