/**
 * JS file for instantiating a11y dialogue instance
 *
 */
import tippy from 'tippy.js'

const Tooltip = () => {
  tippy('[data-tippy-content]', {
    appendTo: 'parent',
    hideOnClick: true,
  })
}

export { Tooltip }
