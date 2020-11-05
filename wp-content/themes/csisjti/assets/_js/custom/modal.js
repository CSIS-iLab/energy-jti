/**
 * JS file for instantiating a11y dialogue instance
 *
 */
import A11yDialog from 'a11y-dialog'

const Modal = () => {
  document
    .getElementById('site-content')
    .addEventListener('click', function () {
      // Get the dialog element (with the accessor method you want)
      const el = document.getElementById('my-accessible-dialog')

      // Instantiate a new A11yDialog module
      // const dialog = new A11yDialog( el );
    })

  console.log('test')
  console.log('foobar!')
}

export { Modal }
