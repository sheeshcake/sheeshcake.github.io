import { useState } from 'react'
import AnimatedCursor from "react-animated-cursor"
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import Hero from './sections/Hero'
import Header from './components/Header'
import Background from './components/Background'

function App() {
  return (
    <div class="b wrapall">
      {/* <AnimatedCursor
        color="black"
        innerSize={8}
        outerSize={35}
        innerScale={1}
        outerScale={1.7}
        outerAlpha={0}
        outerStyle={{
          mixBlendMode: 'exclusion'
        }}
      /> */}
      <Background />
      <Header />
      <Hero />
      
    </div>
  )
}

export default App
