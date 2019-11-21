import React, {Component} from 'react';
import axios from 'axios';
import mixer from '../../images/mixerdark.png'
import twitch from '../../images/twitch.png'
import youtube from '../../images/youtube3.png'
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export default class Stream extends Component {

    constructor(props) {
        super(props);

        this.state = {
            follow: false
        }
    }

    componentDidMount() {
        if (this.props.followed.includes(this.props.stream.user)) {
            this.setState({follow: true})
        }
    }

    componentDidUpdate(nextProps) {
        if (nextProps.followed !== this.props.followed) {
            if (this.props.followed.includes(this.props.stream.user)) {
                this.setState({follow: true})
            }
        }
    }

    follow(e) {
        e.preventDefault();
        this.setState({follow: !this.state.follow})
        this.props.follow(this.props.stream.user);
    }

    render() {
        return (
            <div className="column is-4-tablet is-3-desktop is-11-mobile">
                <a href={"/stream/" + this.props.stream.platform + "/" + this.props.stream.user}>
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
                            <div className="content is-relative">
                                <p className="stream__title">{this.props.stream.title}</p>
                                <p className="stream__game">{this.props.stream.game}</p>
                                {localStorage.getItem('user') !== ''
                                    ?
                                    <FontAwesomeIcon onClick={(e) => this.follow(e)}
                                                     className={this.state.follow ? "stream__follow is-followed" : "stream__follow"}
                                                     icon="heart" size="lg"/>
                                    : ''
                                }

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        );
    }
}

