// ;(function ($) {
//   $(document).on('facetwp-loaded', function () {
//     modifyFSelectFacet()
//   })

//   function modifyFSelectFacet() {
//     console.log(FWP)

//     $('.facetwp-checkbox').each(function () {
//       const $facet = $(this)
//       const facet_name = $facet.attr('data-value')
//       const facet_label = facet_name
//       console.log(this)
//       // Add Facet Label
//       const label = document.createElement('div')
//       label.classList.add('fs-label-field')
//       label.innerHTML = facet_label
//       console.log(this)
//       this.prepend(label)
//     })
//   }
// })(jQuery)

;(function ($) {
  $(document).on('facetwp-loaded', function () {
    modifyCheckboxes()
    modifyFSelectFacet()
    modifyMultiSelect()
  })

  function modifyFSelectFacet() {
    console.log(FWP)

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

  function modifyCheckboxes() {

    $('.facetwp-facet-sectors_checkboxes .facetwp-checkbox').each(function () {
      const span = document.createElement('span')
      span.classList.add('fs-checkbox')
      span.innerHTML = '<i></i>'

      this.prepend(span)
    })
  }

  function modifyMultiSelect() {

    $('.filters-modal .facetwp-type-fselect').each(function () {
      this.querySelector('.fs-dropdown').classList.remove('hidden')
      this.querySelector('.fs-dropdown').classList.add('fs-show')
      this.querySelector('.fs-options').classList.add('hidden')

      this.querySelector('.fs-search input').setAttribute('placeholder', 'Type here to filter list')
      
        $('.fs-search', this).on('click', function() {
          const fs_wrap = $(this).parents('.fs-wrap')[0]

          if (fs_wrap.classList.contains('fs-active')) {
            fs_wrap.classList.remove('fs-active')
          } else {
            fs_wrap.classList.add('fs-active')
          }
        })
    })
  }
})(jQuery)