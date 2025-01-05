import React from 'react'
import Background from './Background'

function Header() {
    return (
        <>
            <Background />
            <header id="header" class="header">
                <div class="wrapper">
                    <nav class="nav">
                        <a href="/" class="nav__logo header__item">Wendale Dy</a>
                        <div class="nav__links">
                            <a href="#about" class="nav__link js--nav-link header__item text-link">About</a>
                            <a href="https://nibbleph.dev/#portfolio" class="nav__link js--nav-link header__item text-link">Work</a>
                            <a href="https://nibbleph.dev/#services" class="nav__link js--nav-link header__item text-link">Services</a>
                            <a href="mailto:wendalefranz.dy@gmail.com" class="nav__link header__item text-link">Drop me a line</a>
                        </div>
                        {/* <label class="nav__theme header__item" >
                            <div class="nav__theme__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" class="cc-moon">
                                <path fill="none" d="M0 0h12v12H0z"></path>
                                <path fill="currentColor" d="M6.315 10.617q-.223 0-.448-.02a4.93 4.93 0 0 1-.876-9.66.394.394 0 0 1 .486.486 4.142 4.142 0 0 0 5.1 5.1.394.394 0 0 1 .486.486 4.943 4.943 0 0 1-4.748 3.608Zm-1.741-8.69a4.142 4.142 0 1 0 5.5 5.5 4.931 4.931 0 0 1-5.5-5.5Z"></path></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.997 11.999" class="cc-sun"><path fill="currentColor" d="M5.599 11.601v-1a.4.4 0 0 1 .4-.4.4.4 0 0 1 .4.4v1a.4.4 0 0 1-.4.4.4.4 0 0 1-.4-.4Zm4.075-1.356-.708-.707a.4.4 0 0 1 0-.565.4.4 0 0 1 .567 0l.705.707a.4.4 0 0 1 0 .565.391.391 0 0 1-.282.117.4.4 0 0 1-.28-.12Zm-7.919 0a.4.4 0 0 1 0-.565l.707-.707a.4.4 0 0 1 .565 0 .4.4 0 0 1 0 .565l-.707.707a.39.39 0 0 1-.283.117.393.393 0 0 1-.28-.12Zm.493-4.533a3.463 3.463 0 0 1 3.457-3.46 3.463 3.463 0 0 1 3.457 3.46 3.46 3.46 0 0 1-3.457 3.456A3.46 3.46 0 0 1 2.25 5.709Zm.813 0a2.648 2.648 0 0 0 2.645 2.642 2.646 2.646 0 0 0 2.645-2.642 2.647 2.647 0 0 0-2.645-2.645 2.649 2.649 0 0 0-2.644 2.642Zm7.537.689a.4.4 0 0 1-.4-.4.4.4 0 0 1 .4-.4h1a.4.4 0 0 1 .4.4.4.4 0 0 1-.4.4Zm-10.2 0a.4.4 0 0 1-.4-.4.4.4 0 0 1 .4-.4h1a.4.4 0 0 1 .4.4.4.4 0 0 1-.4.4Zm8.568-3.367a.4.4 0 0 1 0-.568l.708-.705a.4.4 0 0 1 .564 0 .4.4 0 0 1 0 .565l-.705.708a.407.407 0 0 1-.284.114.406.406 0 0 1-.281-.117Zm-6.5 0-.707-.708a.4.4 0 0 1 0-.565.4.4 0 0 1 .565 0l.707.705a.4.4 0 0 1 0 .568.406.406 0 0 1-.282.114.4.4 0 0 1-.285-.117Zm3.137-1.632v-1a.4.4 0 0 1 .4-.4.4.4 0 0 1 .4.4v1a.4.4 0 0 1-.4.4.4.4 0 0 1-.404-.401Z"></path>
                                </svg>
                            </div>
                            <input id="toggleTheme" type="checkbox" name="theme" class="nav__theme__toggle"/>
                            <div id="toggleThemeText" class="nav__theme__text">Light</div>
                        </label> */}
                    </nav>
                </div>
            </header>
        </>
    )
}

export default Header