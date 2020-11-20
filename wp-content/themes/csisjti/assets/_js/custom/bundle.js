import { Navigation } from './navbar'
import { setScrollbarSize } from './scrollbar'
import { setGapSupport } from './flex-gap'

document.addEventListener('DOMContentLoaded', function () {
  setScrollbarSize()
  Navigation()
  setGapSupport()
})
