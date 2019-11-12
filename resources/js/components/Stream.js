import React, {Component} from 'react';
import axios from 'axios';
import mixer from '../../images/mixerdark.png'
import twitch from '../../images/twitch.png'
import youtube from '../../images/youtube3.png'

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
                    <div className="card is-relative">

                        <div className="card-image">
                            <figure className="image is-352x198">
                                <img className="stream__img"
                                     src={this.props.stream.preview}
                                     alt="live stream preview image"/>
                            </figure>
                        </div>
                        <div className="card-content is-relative">
                            {this.props.stream.platform === 'twitch' ?
                                <figure className="image is-24x24 streams__mixer--absolute">
                                    <img className="streams__mixer--absolute" src={twitch} alt="twitch logo icon"/>
                                </figure>
                                :
                                this.props.stream.platform === 'mixer' ?
                                    <figure className="image is-24x24 streams__mixer--absolute">
                                        <img className="streams__mixer--absolute" src={mixer} alt="twitch logo icon"/>
                                    </figure>
                                    :
                                    <figure className="image is-24x24 streams__mixer--absolute">
                                        <img className="streams__mixer--absolute" src={youtube} alt="twitch logo icon"/>
                                    </figure>
                            }
                            <div className="media">
                                <div className="media-left">
                                    <figure className="image is-48x48">
                                        <img className="is-rounded"
                                             src={this.props.stream.logo}
                                             alt="live streamer avatar"/>
                                    </figure>
                                </div>
                                <div className="media-content">
                                    <p className="stream__channel">{this.props.stream.user}</p>

                                    <span style={{color: 'white'}}><i className="far fa-eye"/></span>
                                    <p style={{paddingLeft: '5px'}}
                                       className="stream__viewers">{' ' + this.props.stream.viewers}</p>
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

