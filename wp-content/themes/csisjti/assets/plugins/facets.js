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
    modifyFSelectFacet()
  })

  function modifyFSelectFacet() {
    console.log(FWP)

    $('.facetwp-checkbox').each(function () {
      const span = document.createElement('span')
      span.classList.add('fs-checkbox')
      span.innerHTML = '<i></i>'

      this.prepend(span)
    })
  }
})(jQuery)