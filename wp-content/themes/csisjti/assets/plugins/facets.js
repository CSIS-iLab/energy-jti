;(function ($) {
  const numFiltersApplied = document.querySelectorAll('.fp-num_filters_applied')

  let hasRun = false

  $(document).on('facetwp-refresh', function () {
    if (FWP.soft_refresh == true) {
      FWP.enable_scroll = true
    } else {
      FWP.enable_scroll = false
    }
  })

  $(document).on('facetwp-loaded', function () {
    if (FWP.enable_scroll == true) {
      const top = $('.resource-library__content').offset().top - 100
      $(window).scrollTop(top)
    }

    fwpDisableAutoRefresh()
    modifyCheckboxes()
    modifySearchFacet()
    fSelectFacetApply()
    modifyFSelectFacet()
    modifyFSelectLabels()
    modifyExpandIcons()
    setNumFilters()
    customizeDatePicker()
    connectFacets()
    hideExtraFacets()
    enableAutoRefreshSpecificFacets()
    runExpandCheckboxFacet()
    hasRun = true
  })

  // Disable auto-refresh
  function fwpDisableAutoRefresh() {
    $(function () {
      if ('undefined' !== typeof FWP) {
        FWP.auto_refresh = false
      }
    })
  }

  // Connects values from side search to modal search.
  function connectFacets() {
    // Facet Names: ['side', 'modal']
    const pairs = [
      ['analysis_type', 'analysis_type_modal'],
      ['sectors', 'sectors_modal'],
      ['geographic_focus', 'geographic_focus_modal'],
      ['focus_areas', 'focus_areas_modal'],
      ['format', 'format_modal'],
      ['keywords', 'keywords_modal'],
      ['publishing_organization', 'publishing_organization_modal'],
      ['publishing_organization_type', 'publishing_organization_type_modal'],
      ['author', 'author_modal'],
    ]

    let tempFacets = []
    if (!hasRun) {
      // Open the Modal by clicking the "Filters" button.
      document
        .getElementById('filters-btn')
        .addEventListener('click', function () {
          // Set our temp facets, which we'll use in case the user closes the modal without applying.
          tempFacets = FWP.facets

          for (let i = 0; i < pairs.length; i++) {
            const pair = pairs[i]

            if ('undefined' !== typeof FWP.facets[pair[0]]) {
              FWP.facets[pair[1]] = FWP.facets[pair[0]] // Copy value of side search to Modal
              FWP.facets[pair[0]] = [] // Clear side values
            }
          }
          FWP.fetch_data()
        })

      // Close the modal without saving anything. Revert back to what we had in our side search.
      document
        .querySelector('.dialog-close')
        .addEventListener('click', function () {
          if (tempFacets.length === 0) {
            return
          }
          FWP.facets = tempFacets
          FWP.parse_facets()
          for (let i = 0; i < pairs.length; i++) {
            const pair = pairs[i]
            if ('undefined' !== typeof FWP.facets[pair[0]]) {
              FWP.facets[pair[0]] = tempFacets[pair[1]] // Copy temp value to side search
              FWP.facets[pair[1]] = [] // Clear modal values
            }
          }
          tempFacets = []
          FWP.fetch_data()
        })

      // Click on the "Apply" button in the modal.
      document
        .getElementById('filters-apply-btn')
        .addEventListener('click', function () {
          FWP.parse_facets()
          for (let i = 0; i < pairs.length; i++) {
            const pair = pairs[i]
            if ('undefined' !== typeof FWP.facets[pair[0]]) {
              FWP.facets[pair[0]] = FWP.facets[pair[1]] // Copy modal value to side search
              FWP.facets[pair[1]] = [] // Clear modal values
            }
          }
          tempFacets = []
          FWP.fetch_data()
        })
    }
  }

  function modifySearchFacet() {
    // If these fields already exist, don't create them again.
    if (document.querySelector('.fs-search-submit')) {
      return
    }

    // Add Search button to search input since we removed the autorefresh.
    const button = document.createElement('button')
    button.classList.add('fs-search-submit')
    button.innerHTML =
      '<svg class="icon icon-arrow-right"><use xlink:href="#icon-arrow-right"></use></svg>'
    button.setAttribute('aria-label', 'Search Database')
    button.setAttribute('type', 'submit')
    button.addEventListener('click', function () {
      FWP.refresh()
    })

    document
      .querySelector(
        '.resource-library__inline-filters .facetwp-facet-search_input span'
      )
      .append(button)
  }

  function modifyFSelectFacet() {
    $('.facetwp-type-fselect').each(function () {
      const $facet = $(this)
      const facet_name = $facet.attr('data-name')
      const facet_label = FWP.settings.labels[facet_name]

      // Add Number of Selected Options to Wrapper
      const numSelected = FWP.facets[facet_name].length
      this.querySelector('.fs-label-wrap').setAttribute('data-num', numSelected)

      // If these fields already exist, don't create them again.
      if (this.querySelector('.fs-label-field')) {
        return
      }

      // Add Facet Label
      const label = document.createElement('div')
      label.classList.add('fs-label-field')
      label.innerHTML = facet_label

      this.querySelector('.fs-label-wrap').prepend(label)
    })
  }

  function fSelectFacetApply() {
    $('.resource-library__inline-filters .facetwp-type-fselect').each(
      function () {
        // Check if apply button has been added
        const applyBtn = this.querySelector('.fs-fselect-apply')
        if (applyBtn) {
          return
        }

        const applyWrapper = document.createElement('div')
        applyWrapper.classList.add('fs-fselect-apply')
        applyWrapper.innerHTML =
          '<button class="btn btn--filter-apply">Apply</button>'

        const fsWrap = this.querySelector('.fs-wrap')
        const dropdown = this.querySelector('.fs-dropdown')
        dropdown.append(applyWrapper)

        dropdown
          .querySelector('.btn--filter-apply')
          .addEventListener('click', function () {
            fsWrap.classList.toggle('fs-open')
            dropdown.classList.toggle('hidden')
            FWP.refresh()
          })
      }
    )
  }

  function modifyCheckboxes() {
    $('.facetwp-checkbox').each(function () {
      const checkbox = this.querySelector('.fs-checkbox')
      if (checkbox) {
        return
      }

      const span = document.createElement('span')
      span.classList.add('fs-checkbox')
      span.innerHTML = '<i></i>'

      this.prepend(span)
    })
  }

  // Toggle plus and minus icons on user click
  function modifyExpandIcons() {
    $('.facetwp-expand').each(function () {
      $(this).context.classList.add('icon-plus')

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
    // We don't want the pagination or sort to impact the count.

    const excludedFacets = ['pagination', 'sort', 'paged', 'type_of_content']

    const numFilters = Object.keys(FWP.facets)
      .filter((f) => !excludedFacets.includes(f))
      .reduce((acc, curr) => {
        if (FWP.facets[curr] != '' && !Array.isArray(FWP.facets[curr])) {
          return acc + 1
        }
        return acc + FWP.facets[curr].length
      }, 0)

    Array.from(numFiltersApplied).forEach((el) => (el.innerHTML = numFilters))
  }

  // Wires custom date range dropdown to facet functionality
  function datePickerHook() {
    $('.select-options li').each(function () {
      $(this).on('click', function () {
        let startMonth = document.getElementById('date-range--start-month')
          .value
        let startYear = document.getElementById('date-range--start-year').value
        let endMonth = document.getElementById('date-range--end-month').value
        let endYear = document.getElementById('date-range--end-year').value
        const facetDate = document.getElementsByClassName(
          'facetwp-facet-publish_date'
        )[0]

        facetDate.querySelectorAll('.fs-option').forEach(function (el) {
          const startDate = new Date(startYear, startMonth, 1)
          const endDate = new Date(endYear, endMonth, 1)
          const elDate = new Date(
            el.getAttribute('data-value').slice(0, 4),
            el.getAttribute('data-value').slice(4, 6) - 1,
            1
          )
          if (elDate >= startDate && elDate <= endDate) {
            el.click()
          }
        })
      })
    })
  }

  // Creates additional layer of html for custom styling of select
  // Taken from https://codepen.io/wallaceerick/pen/ctsCz
  function customizeDatePicker() {
    $('.date-range--select').each(function () {
      let $this = $(this)
      let numberOfOptions = $(this).children('option').length

      $this.addClass('select-hidden')
      $this.wrap('<div class="select"></div>')
      $this.after('<div class="select-styled"></div>')

      let $styledSelect = $this.next('div.select-styled')
      $styledSelect.text($this.children('option').eq(0).text())

      let $list = $('<ul />', {
        class: 'select-options',
        role: 'listbox',
        tabindex: -1,
      }).insertAfter($styledSelect)

      for (let i = 0; i < numberOfOptions; i++) {
        $('<li />', {
          text: $this.children('option').eq(i).text(),
          rel: $this.children('option').eq(i).val(),
          role: 'option',
        }).appendTo($list)
      }

      let $listItems = $list.children('li')

      $styledSelect.click(function (e) {
        e.stopPropagation()
        $('div.select-styled.active')
          .not(this)
          .each(function () {
            $(this).removeClass('active').next('ul.select-options').hide()
          })
        $(this).toggleClass('active').next('ul.select-options').toggle()
      })

      $listItems.click(function (e) {
        e.stopPropagation()
        $styledSelect.text($(this).text()).removeClass('active')
        $this.val($(this).attr('rel'))
        $list.hide()
      })

      $(document).click(function () {
        $styledSelect.removeClass('active')
        $list.hide()
      })

      datePickerHook()
    })
  }

  // Hides the extra facets from the side search if value is empty.
  function hideExtraFacets() {
    const extraFacets = [
      'keywords',
      'publishing_organization',
      'publishing_organization_type',
      'author',
    ]
    extraFacets.forEach((facet) => {
      document
        .querySelector(
          `.resource-library__inline-filters .facetwp-facet-${facet}`
        )
        .classList.toggle('facetwp-hidden', FWP.facets[facet].length < 1)
    })

    $.each(FWP.settings.num_choices, function (key, val) {
      var $parent = $('.facetwp-facet-' + key).closest('.facet-wrap')
      0 === val ? $parent.hide() : $parent.show()
    })
  }

  // We want to refresh as soon as the user changes the type of content (tabs) or changes the sort order.
  function enableAutoRefreshSpecificFacets() {
    $(document).on('change', '.facetwp-sort-select', function () {
      FWP.refresh()
    })

    $(document).on(
      'click',
      '.facetwp-facet-type_of_content .facetwp-radio',
      function () {
        FWP.refresh()
      }
    )
  }

  function modifyFSelectLabels() {
    $('.filters-modal .facetwp-type-fselect').each(function () {
      let el = this.querySelectorAll('.fs-label-field')[0]
      let label = el.innerText.replace(' Modal', '')
      el.innerText = label
    })
  }

  function runExpandCheckboxFacet() {
    $(document).on('click', '.facetwp-facet-focus_areas_modal', function () {
      modifyExpandCheckboxFacet()
    })
  }

  function modifyExpandCheckboxFacet() {
    $('.facetwp-facet-focus_areas_modal')
      .children('.facetwp-checkbox')
      .each(function () {
        // grabs the checkboxes that have children checkboxes using the facetwp-depth class
        if ($(this).next()[0].classList.contains('facetwp-depth')) {
          // if parent checkbox is selected, check all children
          if ($(this).context.classList.contains('checked')) {
            $(this)
              .next()
              .children()
              .each(function () {
                this.classList.add('checked')
              })
          }
          // check if all children checkboxes are checked if so check parent checkbox
          let allChildrenChecked = true
          $(this)
            .next()
            .children()
            .each(function () {
              if (!this.classList.contains('checked')) {
                allChildrenChecked = false
              }
            })
          if (allChildrenChecked) {
            $(this).context.classList.add('checked')
          }
        }
      })
  }
})(jQuery)
