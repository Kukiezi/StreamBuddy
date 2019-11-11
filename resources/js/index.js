import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Streams from './components/Streams';
import {library} from '@fortawesome/fontawesome-svg-core'
import {fab, far} from '@fortawesome/free-brands-svg-icons'
import "../../node_modules/bulma-extensions/dist/js/bulma-extensions.min"
import {faLongArrowAltLeft} from "@fortawesome/free-solid-svg-icons";

library.add(fab, faLongArrowAltLeft);
ReactDOM.render(<Streams/>, document.getElementById('example'));
