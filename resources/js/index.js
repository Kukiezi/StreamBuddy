import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Streams from './components/Streams';
import {library} from '@fortawesome/fontawesome-svg-core'
import {fab, far} from '@fortawesome/free-brands-svg-icons'
import "../../node_modules/bulma-extensions/dist/js/bulma-extensions.min"
import {faHeart, faLongArrowAltLeft} from "@fortawesome/free-solid-svg-icons";

library.add(fab, faLongArrowAltLeft, faHeart);
const element = document.getElementById('example');
if (element.dataset !== null) {
    const props = Object.assign({}, element.dataset);
    localStorage.setItem('user', props['user']);
}

// localStorage.setItem('user', element.dataset);
ReactDOM.render(<Streams/>, element);
