/* eslint no-undef: 0 */

;(function ($) {
  const numFiltersApplied = document.getElementById('num_filters_applied')

  $(document).on('facetwp-loaded', function () {
    modifyFSelectFacet()
    setNumFilters()
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

  // Calculates the number of active filters applied.
  function setNumFilters() {
    const numFilters = Object.values(FWP.facets).reduce((acc, curr) => {
      if (curr != '' && !Array.isArray(curr)) {
        return acc + 1
      }
      return acc + curr.length
    }, 0)
    numFiltersApplied.innerHTML = numFilters
  }
})(jQuery)
