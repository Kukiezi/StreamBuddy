import React, {Component} from 'react';
import axios from 'axios';

export default class Stream extends Component {

    constructor(props) {
        super(props);

        this.state = {}
    }

    componentDidMount() {

    }

    render() {
        return (
            <div className="column is-4-tablet is-3-desktop is-11-mobile">
                <a target="_blank"
                   href={this.props.stream.url}>
                    <div className="card">
                        <div className="card-image">
                            <figure className="image is-352x198">
                                <img className="stream__img"
                                     src={this.props.stream.preview}
                                     alt="Placeholder image"/>
                            </figure>
                        </div>
                        <div className="card-content">
                            <div className="media">
                                <div className="media-left">
                                    <figure className="image is-48x48">
                                        <img className="is-rounded"
                                             src={this.props.stream.logo}
                                             alt="Placeholder image"/>
                                    </figure>
                                </div>
                                <div className="media-content">
                                    <p className="stream__channel">{this.props.stream.user}</p>

                                    <span style={{color: 'white'}}><i className="far fa-eye"/></span>
                                    <p style={{paddingLeft: '5px'}} className="stream__viewers">{' ' + this.props.stream.viewers}</p>
                                </div>
                            </div>

                            <div className="content">
                                <p className="stream__title">{this.props.stream.title}</p>
                                <p
                                   className="stream__game">{this.props.stream.game}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    );
    }
    }

