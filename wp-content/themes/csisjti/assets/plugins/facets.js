;(function ($) {
  const numFiltersApplied = document.getElementById('num_filters_applied')

  $(document).on('facetwp-loaded', function () {
    modifyCheckboxes()
    modifyFSelectFacet()
    modifyMultiSelect()
    modifyExpandIcons()
    // fwpDisableAutoRefresh()
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

  function modifyCheckboxes() {
    $('.facetwp-checkbox').each(function () {
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

  // Toggle plus and minus icons on user click
  function modifyExpandIcons() {
    $('.facetwp-expand').each(function () {
      $(this).context.classList.add('icon-minus')

      $(this).on('click', () => {
        if ($(this).context.innerHTML.includes('-')) {
          $(this).context.classList.remove('icon-minus')
          $(this).context.classList.add('icon-plus')
        } else {
          $(this).context.classList.remove('icon-plus')
          $(this).context.classList.add('icon-minus')
        }
      })
    })
  }
    // function fwpDisableAutoRefresh() {
    //   $(function() {
    //     if ('undefined' !== typeof FWP) {
    //       FWP.auto_refresh = false;
    //     }
    // });
    // }

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
