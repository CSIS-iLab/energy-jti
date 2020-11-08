;(function ($) {
  $(document).on('facetwp-loaded', function () {
    modifyFSelectFacet()
  })

  function modifyFSelectFacet() {
    console.log(FWP)

    $('.facetwp-type-checkboxes').each(function () {
      const $facet = $(this)
      const facet_name = $facet.attr('data-name')
      const facet_label = FWP.settings.labels[facet_name]
      console.log(this)
      // Add Facet Label
      const label = document.createElement('div')
      label.classList.add('fs-label-field')
      label.innerHTML = facet_label
      console.log(this)
      this.querySelector('.fs-label-wrap').prepend(label)

      // Add Number of Selected Options to Wrapper
      const numSelected = FWP.facets[facet_name].length
      this.querySelector('.fs-label-wrap').setAttribute('data-num', numSelected)
    })
  }
})(jQuery)