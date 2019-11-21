import React, {Component} from 'react';
import axios from 'axios';
import mixer from '../../images/mixerdark.png'
import twitch from '../../images/twitch.png'
import youtube from '../../images/youtube3.png'
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export default class Game extends Component {

    constructor(props) {
        super(props);

        this.state = {
            follow: false
        }
    }

    componentDidMount() {

    }


    render() {
        return (
            <div className="column is-2-tablet is-6-mobile popular-games__column popular-games">
                <a href={"/game/" + this.props.game.name}>
                    <div className="card">
                        <div className="card-image">
                            <figure className="image is-128x128-mobile">
                                <img className="popular__img"
                                     src={this.props.game.image}
                                     alt="live stream preview image"/>
                            </figure>
                        </div>
                        <div className="card-content">
                            <div className="content">
                                <p className="popular__title">{this.props.game.name}</p>
                                <span style={{color: 'white'}}> <i className="far fa-eye"/></span>
                                <p style={{paddingLeft: '5px'}} className="popular__viewers">{' ' + this.props.game.viewers} </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        );
    }
}

