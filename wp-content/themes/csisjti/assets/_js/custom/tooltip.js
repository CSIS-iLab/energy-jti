/**
 * JS file for instantiating a11y dialogue instance
 *
 */
import tippy from 'tippy.js'

const Tooltip = () => {
  console.log('hello')
  tippy('.filters-modal__subheading', {
    content: 'Tooltip',
  })
}

export { Tooltip }
