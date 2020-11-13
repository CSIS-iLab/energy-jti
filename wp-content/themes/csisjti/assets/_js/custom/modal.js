/**
 * JS file for instantiating a11y dialogue instance
 *
 */
import A11yDialog from 'a11y-dialog'

const Modal = () => {
  const el = document.getElementById('accessible-dialog')
  new A11yDialog(el)
}

const filterModal = () => {
  const filterBtn = document.getElementById('filters-btn')

  filterBtn.addEventListener('click', () => {
    const classification = document.getElementsByClassName(
      'classification-modal'
    )[0]
    const filter = document.getElementsByClassName('filters-modal')[0]
    classification.classList.add('hidden')
    filter.classList.remove('hidden')
  })
}

const classificationModal = () => {
  const classificationBtn = document.getElementById('classification-btn')

  classificationBtn.addEventListener('click', () => {
    const classification = document.getElementsByClassName(
      'classification-modal'
    )[0]
    const filter = document.getElementsByClassName('filters-modal')[0]
    classification.classList.remove('hidden')
    filter.classList.add('hidden')
  })
}

// Close modal on click of apply button 
const applyFilters = () => {
  const applyBtn = document.getElementById('filters-apply-btn')
  const closeBtn = document.getElementsByClassName('dialog-close')[0]

  applyBtn.addEventListener('click', () => {
    closeBtn.click()
  })
}

export { Modal, filterModal, classificationModal, applyFilters }
