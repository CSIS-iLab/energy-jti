/**
 * JS file for toggling classes on the navbar
 *
 */


// dynamically change color of border-top element depending on which page user navigates to
document.addEventListener('DOMContentLoaded', function () {

    const listItems = document.getElementsByClassName('primary-menu')[0].children

    const activeEl = Array.from(listItems).find(el => el.children[0].href === window.location.href)

    if (!activeEl) {return}

    activeEl.classList.add('active')

    switch (activeEl.children[0].href.split('/')[3]) {
      case 'resource-library':
        activeEl.style.setProperty('--borderTopColor', 'var(--color-nav-resource)')
        break
      case 'jti-analysis':
        activeEl.style.setProperty('--borderTopColor', 'var(--color-nav-analysis)')
        break
      case 'events':
        activeEl.style.setProperty('--borderTopColor', 'var(--color-nav-event)')
        break
      case 'about-just-transitions':
        activeEl.style.setProperty('--borderTopColor', 'var(--color-nav-transition)')
        break
      case 'about-jti':
        activeEl.style.setProperty('--borderTopColor', 'var(--color-nav-jti)')
        break
    }
  })
  