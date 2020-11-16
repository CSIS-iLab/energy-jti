/**
 * JS file for instantiating a11y dialogue instance
 *
 */
import tippy from 'tippy.js'

const Tooltip = () => {
  tippy('.filters-modal__subheading', {
    content: 'Tooltip',
    appendTo: 'parent',
    zIndex: 9999999999999999,
  })
}

export { Tooltip }
