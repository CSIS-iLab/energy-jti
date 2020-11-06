/**
 * JS file for instantiating a11y dialogue instance
 *
 */
import A11yDialog from 'a11y-dialog'

const Modal = () => {
  const el = document.getElementById('my-accessible-dialog')
  new A11yDialog(el)
}

export { Modal }
