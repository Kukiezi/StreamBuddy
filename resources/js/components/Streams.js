import React, {Component} from 'react';
import Stream from './Stream';
import axios from 'axios';
import mixer from '../../images/mixerdark.png'
import twitch from '../../images/twitch.png'
import youtube from '../../images/youtube3.png'
import {FontAwesomeIcon} from '@fortawesome/react-fontawesome'
import Game from "./Game";

export default class Streams extends Component {

    constructor(props) {
        super(props);
        this.isBottom = this.isBottom.bind(this);
        this.trackScrolling = this.trackScrolling.bind(this);
        this.loadMore = this.loadMore.bind(this);
        this.filterChanged = this.filterChanged.bind(this);
        this.follow = this.follow.bind(this);
        this.handleScroll = this.handleScroll.bind(this);
        this.state = {
            streams: [],
            filter: [],
            followed: [],
            games: []
        }
    }

    componentDidMount() {
        axios.post('api/loadMore', {'id': 0, 'platform': []})
            .then((response) => {
                this.setState({streams: response.data})
                document.addEventListener('scroll', this.trackScrolling);

            })

        axios.get('api/games')
            .then((response) => {
                this.setState({games: response.data})
            })

        axios.post('api/getFollowers',
            {'userId': localStorage.getItem('user')})
            .then((response) => {
                this.setState({
                    ...this.state,
                    followed: response.data
                })
            })
    }

    componentWillUnmount() {
        document.removeEventListener('scroll', this.trackScrolling);
    }

    loadMore() {
        axios.post('api/loadMore', {
            'id': this.state.streams[this.state.streams.length - 1].id,
            platform: this.state.filter
        })
            .then(async (response) => {
                let streams = [...this.state.streams];
                const newStreams = streams.concat(response.data);
                if (streams.length !== newStreams.length) {
                    this.setState({streams: newStreams}, () => {
                        document.addEventListener('scroll', this.trackScrolling);
                    })
                }
            })
    }

    follow(streamer) {
        axios.post('api/follow', {
            'streamer': streamer,
            'userId': localStorage.getItem('user')
        })
            .then(() => {

            })
    }

    filterChanged() {
        axios.post('api/loadMore', {'id': 0, platform: this.state.filter})
            .then(async (response) => {
                let streams = [...this.state.streams];
                const newStreams = response.data;
                this.setState({streams: newStreams}, () => {
                    document.addEventListener('scroll', this.trackScrolling);
                })
            })
    }

    isBottom(el) {
        return el.getBoundingClientRect().bottom <= window.innerHeight;
    }

    handleScroll(e) {
        const bottom = e.target.scrollHeight - e.target.scrollTop === e.target.clientHeight;
        if (bottom) {
            this.loadMore();
        }
    }

    trackScrolling() {
        const wrappedElement = document.getElementById('streams');
        if (this.isBottom(wrappedElement)) {
            document.removeEventListener('scroll', this.trackScrolling);
            this.loadMore();
        }
    };

    handleChecked(event) {
        if (event.target.checked) {
            let filter = [...this.state.filter];
            filter.push(event.target.value);
            this.setState({
                ...this.state,
                filter: filter
            }, () => this.filterChanged())
        } else {
            let filter = [...this.state.filter];
            const index = filter.indexOf(event.target.value);
            if (index !== -1) {
                filter.splice(index, 1);
                this.setState({
                    ...this.state,
                    filter: filter
                }, () => this.filterChanged())
            }
        }
    }

    render() {
        let streams;
        let games;
        if (this.state.streams.length > 0) {
            streams = this.state.streams.map((stream) =>
                <Stream key={stream.id} follow={this.follow} followed={this.state.followed} stream={stream}/>
            );
        } else {
            streams = <div></div>
        }

        if (this.state.games.length > 0) {
            games = this.state.games.map((game) =>
                <Game key={game.id} game={game}/>
            );
        } else {
            games = <div></div>
        }

        return (
            <div className="columns is-multiline is-centered react-streams" onScroll={this.handleScroll}>
                <div className="column is-11 streams">
                    <div className="columns is-mobile is-multiline is-centered">
                        <div className="column is-12-desktop is-11-mobile is-12-tablet">
                            <h1 className="streams__header">Popular Games</h1>
                        </div>
                    </div>
                    <div className="columns is-multiline is-centered popular is-mobile">
                        {games}
                    </div>
                    <div className="columns is-mobile is-multiline is-centered">


                        <div className="column is-6-desktop is-11-mobile is-12-tablet">
                            <h1 className="streams__header">Browse Streams</h1>
                        </div>

                        <div className="column is-4-touch is-hidden-mobile">
                            <p className="streams__filter-text">Filter by platforms...</p>
                        </div>
                        <div className="column is-8-tablet-only is-3-desktop is-12-mobile streams__filter-column">
                            <div className="columns is-mobile is-centered is-multiline">
                                <div className="column is-4-tablet is-11-mobile">
                                    <div className="streams__mixer-box is-relative">
                                        <div className="field">
                                            <input id="switchTwitch" type="checkbox" name="switchTwitch"
                                                   className="switch is-rtl is-warning" value="twitch"
                                                   checked={this.state.filter.includes('twitch')}
                                                   onChange={(event) => this.handleChecked(event)}/>
                                            <label className="streams__filter-image" htmlFor="switchTwitch">
                                                <figure style={{display: 'inline-block'}}
                                                        className="image is-24x24">
                                                    <img className="streams__mixer" src={twitch}
                                                         alt="twitch logo icon"/>
                                                </figure>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div className="column is-4-tablet  is-11-mobile">
                                    <div className="streams__mixer-box is-relative">
                                        <div className="field">
                                            <input id="switchMixer" type="checkbox" name="switchMixer"
                                                   className="switch is-rtl is-info" value="mixer"
                                                   onChange={(event) => this.handleChecked(event)}/>
                                            <label className="streams__filter-image" htmlFor="switchMixer">
                                                <figure style={{display: 'inline-block', maxHeight: '24px'}}
                                                        className="image is-24x24">
                                                    <img className="streams__mixer" src={mixer}
                                                         alt="mixer.com logo icon"/>
                                                </figure>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div className="column is-4-tablet  is-11-mobile">
                                    <div className="streams__mixer-box is-relative">
                                        <div className="field">
                                            <input id="switchYoutube" type="checkbox" name="switchYoutube"
                                                   className="switch is-rtl is-danger" value="youtube"
                                                   onChange={(event) => this.handleChecked(event)}/>
                                            <label className="streams__filter-image" htmlFor="switchYoutube">
                                                <figure style={{display: 'inline-block'}}
                                                        className="image is-24x24">
                                                    <img className="streams__mixer" src={youtube}
                                                         alt="youtube logo icon"/>
                                                </figure>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="columns is-multiline stream is-centered is-mobile" id="streams">
                        {streams}
                    </div>
                </div>
            </div>
        );
    }
}

