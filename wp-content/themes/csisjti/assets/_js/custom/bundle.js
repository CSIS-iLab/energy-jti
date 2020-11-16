import { Navigation } from './navbar'
import { setScrollbarSize } from './scrollbar'
import { Tooltip } from './tooltip'

document.addEventListener('DOMContentLoaded', function () {
  setScrollbarSize()
  Navigation()
  Tooltip()
})
