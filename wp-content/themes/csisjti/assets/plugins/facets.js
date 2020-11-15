;(function ($) {
  const numFiltersApplied = document.getElementById('num_filters_applied')

  $(document).on('facetwp-loaded', function () {
    modifyCheckboxes()
    modifyFSelectFacet()
    modifyMultiSelect()
    modifyExpandIcons()
    fwpDisableAutoRefresh()
    setNumFilters()
    datePickerHook()
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
      
      // Close dropdown on outside click
      $('.filters-modal').on('click', function() {
        $('.fs-active').each(function() {
          if ($(this)[0].classList.contains('fs-active')) {
            $(this)[0].classList.remove('fs-active')
          } 
        })
      })

      // Logic to open dropdown or close on self-click
      $('.fs-search', this).on('click', function(event) {
        const fs_wrap = $(this).parents('.fs-wrap')[0]

        if (fs_wrap.classList.contains('fs-active')) {
          fs_wrap.classList.remove('fs-active')
        } else {
          event.stopPropagation()
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

  // Disable auto-refresh on filterModal
  function fwpDisableAutoRefresh() {
    $(function() {
      if ('undefined' !== typeof FWP) {
        FWP.auto_refresh = false;
      }
    });
  }

  function datePickerHook() {
    $('.date-range--select').each(function() {
      $(this).on('change', function() {
        let startMonth = document.getElementById('date-range--start-month').value
        let startYear = document.getElementById('date-range--start-year').value
        let endMonth = document.getElementById('date-range--end-month').value
        let endYear = document.getElementById('date-range--end-year').value
        const facetDate = document.getElementsByClassName('facetwp-facet-publish_date')[0]
        facetDate.querySelectorAll('.fs-option').forEach(function(el) {
          const startDate = new Date(startYear, startMonth - 1, 1);
          const endDate = new Date(endYear, endMonth - 1, 1);
          const elDate = new Date(el.getAttribute('data-value').slice(0,4), el.getAttribute('data-value').slice(4,6) - 1, 1)
          console.log(elDate < endDate)
          console.log(endDate)
          if (elDate >= startDate && elDate <= endDate) {
            console.log('h')
            el.click()
          }
        })
      })
    })
  }
})(jQuery)
