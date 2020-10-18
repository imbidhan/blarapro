<template>
    <div class="online-play-tab-part">
        <ul class="nav customSportsTab" id="myTab" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">
                    <i class="flaticon-trophy"></i>
                    <span>All sports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="cricket-tab" data-toggle="tab" href="#cricket" role="tab" aria-controls="cricket" aria-selected="false">
                    <i class="flaticon-cricket criCusColor"></i>
                    <span>cricket</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="football-tab" data-toggle="tab" href="#football" role="tab" aria-controls="football" aria-selected="false">
                    <i class="flaticon-football footCusColor"></i>
                    <span>football</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="bascketball-tab" data-toggle="tab" href="#bascketball" role="tab" aria-controls="bascketball" aria-selected="false">
                    <i class="flaticon-basketball bascketCusColor"></i>
                    <span>bascketball</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="baseball-tab" data-toggle="tab" href="#baseball" role="tab" aria-controls="baseball" aria-selected="false">
                    <i class="flaticon-softball baseCusColor"></i>
                    <span>volleyball</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tennis-tab" data-toggle="tab" href="#tennis" role="tab" aria-controls="tennis" aria-selected="false">
                    <i class="flaticon-tennis-racket tennisCusColor"></i>
                    <span>tennis</span>
                </a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

                <div v-for="(sportItems, key) in matches" class="sports_single_category">

                    <h4 v-for="(matchCategory, key) in sportItems" class="text-center" v-if="key == 0">
                        <img v-if="matchCategory['sportName'] == 'cricket'" :src="`backend/uploads/users/cricketTwo.png`" alt="image" width="20">
                        <img v-if="matchCategory['sportName'] == 'football'" :src="`backend/uploads/users/football.png`" alt="image" width="20">
                        <img v-if="matchCategory['sportName'] == 'basket'" :src="`backend/uploads/users/basketball.png`" alt="image" width="20">
                        <img v-if="matchCategory['sportName'] == 'volley'" :src="`backend/uploads/users/volley.png`" alt="image" width="20">
                        <img v-if="matchCategory['sportName'] == 'tennis'" :src="`backend/uploads/users/tennis.png`" alt="image" width="20">
                        {{ matchCategory["sportName"] | capitalizeFirstLetter}}
                    </h4>

                    <div  v-for="(match, key) in sportItems">
                        <div class="matchTournamentLiveWrap">
                            <div class="matchTournamentDetailPart">
                                <p>
                                    {{ match["tournamentName"] | capitalizeFirstLetter }}

                                    <span class="badge badge-warning">{{ match["matchDateTime"] | dateformat}}</span>
                                    <span class="badge badge-danger"> {{ match["matchDateTime"] | timeformat}}</span>
                                </p>
                                <p>
                                    {{ match["matchTitle"] }}
                                </p>
                            </div>

                            <div class="matchTournamentLivePart">
                                <span v-if="match['status'] == 3" class="liveNotification"><b class="liveDot"></b>Live</span>
                                <span v-else="match['status'] == 2" class="upcomingNotification">Upcoming</span>
                                <span v-if="match['overs'] != null && match['status'] == 3" class="matchOver"> Overs {{ match["overs"] }} </span>
                                <span v-if="match['status'] == 3" class="matchScores">{{ match["score"] }}</span>
                                <span v-if="match['status'] == 2" class="matchScores">{{ match["score"] }}</span>
                            </div>

                        </div>
                        <div v-for="(matchesOption, key) in match['matchOption']">
                            <div class="team-name-part">
                                <div class="content">
                                    <span class="name badge badge-dark">{{ matchesOption["matchOption"] | capitalizeFirstLetter}}</span>
                                </div>
                            </div>
                            <div class="choice-team-part">
                                <button v-for="(betDetail, key) in matchesOption['betDetails']" @click="clickSingleBetDetail(betDetail,matchesOption['matchOption'])" :class="[(matchesOption['betDetails'].length == 2) ? 'single-item-for-mobile clickSingleBetDetail' : 'single-item clickSingleBetDetail']" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="" data-keyboard="false">
                                <span >{{ betDetail['betName'] }} &nbsp;
                                    <b class="text-primary" v-if="betDetail['status'] == 0"> $</b>
                                    <b class="text-primary" v-else-if="betDetail['status'] == 1"> {{ betDetail['betRate'] }}</b>
                                </span>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="cricket" role="tabpanel" aria-labelledby="cricket-tab">
                <div class="sports_single_category">
                    <h4  class="text-center">
                        <img :src="`backend/uploads/users/cricketTwo.png`" alt="image" width="20">
                        Cricket
                    </h4>
                    <div v-for="(match, key) in matches[0]">
                        <div class="matchTournamentLiveWrap">
                            <div class="matchTournamentDetailPart">
                                <p>
                                    {{ match["tournamentName"] | capitalizeFirstLetter }}
                                    <span class="badge badge-warning">{{ match["matchDateTime"] | dateformat}}</span>
                                    <span class="badge badge-danger"> {{ match["matchDateTime"] | timeformat}}</span>
                                </p>
                                <p>
                                    {{ match["matchTitle"] }}
                                </p>
                            </div>

                            <div class="matchTournamentLivePart">
                                <span v-if="match['status'] == 3" class="liveNotification"><b class="liveDot"></b>Live</span>
                                <span v-else="match['status'] == 2" class="upcomingNotification">Upcoming</span>
                                <span v-if="match['overs'] != null && match['status'] == 3" class="matchOver"> Overs {{ match["overs"] }} </span>
                                <span v-if="match['status'] == 3" class="matchScores">{{ match["score"] }}</span>
                            </div>

                        </div>
                        <div v-for="(matchesOption, key) in match['matchOption']">
                            <div class="team-name-part">
                                <div class="content">
                                    <span class="name badge badge-dark">{{ matchesOption["matchOption"] | capitalizeFirstLetter}}</span>
                                </div>
                            </div>
                            <div class="choice-team-part">
                                <button v-for="(betDetail, key) in matchesOption['betDetails']" value="" :class="[(matchesOption['betDetails'].length == 2) ? 'single-item-for-mobile clickSingleBetDetail' : 'single-item clickSingleBetDetail']" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                    <span >{{ betDetail['betName'] }} &nbsp; <b class="text-primary"> {{ betDetail['betRate'] }}</b> </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="football" role="tabpanel" aria-labelledby="football-tab">
                <div class="sports_single_category">
                    <h4  class="text-center">
                        <img :src="`backend/uploads/users/football.png`" alt="image" width="20">
                        Football
                    </h4>
                    <div v-for="(match, key) in matches[1]">
                        <div class="matchTournamentLiveWrap">
                            <div class="matchTournamentDetailPart">
                                <p>
                                    {{ match["tournamentName"] | capitalizeFirstLetter }}

                                    <span class="badge badge-warning">{{ match["matchDateTime"] | dateformat}}</span>
                                    <span class="badge badge-danger"> {{ match["matchDateTime"] | timeformat}}</span>
                                </p>
                                <p>
                                    {{ match["matchTitle"] }}
                                </p>
                            </div>

                            <div class="matchTournamentLivePart">
                                <span v-if="match['status'] == 3" class="liveNotification"><b class="liveDot"></b>Live</span>
                                <span v-else="match['status'] == 2" class="upcomingNotification">Upcoming</span>
                                <span v-if="match['overs'] != null && match['status'] == 3" class="matchOver"> Overs {{ match["overs"] }} </span>
                                <span v-if="match['status'] == 3" class="matchScores">{{ match["score"] }}</span>
                            </div>

                        </div>
                        <div v-for="(matchesOption, key) in match['matchOption']">
                            <div class="team-name-part">
                                <div class="content">
                                    <span class="name badge badge-dark">{{ matchesOption["matchOption"] | capitalizeFirstLetter}}</span>
                                </div>
                            </div>
                            <div class="choice-team-part">
                                <button v-for="(betDetail, key) in matchesOption['betDetails']" value="" :class="[(matchesOption['betDetails'].length == 2) ? 'single-item-for-mobile clickSingleBetDetail' : 'single-item clickSingleBetDetail']" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                    <span >{{ betDetail['betName'] }} &nbsp; <b class="text-primary"> {{ betDetail['betRate'] }}</b> </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="bascketball" role="tabpanel" aria-labelledby="bascketball-tab">
                <div class="sports_single_category">
                    <h4  class="text-center">
                        <img :src="`backend/uploads/users/basketball.png`" alt="image" width="20">
                        Basketball
                    </h4>
                    <div v-for="(match, key) in matches[2]">
                        <div class="matchTournamentLiveWrap">
                            <div class="matchTournamentDetailPart">
                                <p>
                                    {{ match["tournamentName"] | capitalizeFirstLetter }}

                                    <span class="badge badge-warning">{{ match["matchDateTime"] | dateformat}}</span>
                                    <span class="badge badge-danger"> {{ match["matchDateTime"] | timeformat}}</span>
                                </p>
                                <p>
                                    {{ match["matchTitle"] }}
                                </p>
                            </div>

                            <div class="matchTournamentLivePart">
                                <span v-if="match['status'] == 3" class="liveNotification"><b class="liveDot"></b>Live</span>
                                <span v-else="match['status'] == 2" class="upcomingNotification">Upcoming</span>
                                <span v-if="match['overs'] != null && match['status'] == 3" class="matchOver"> Overs {{ match["overs"] }} </span>
                                <span v-if="match['status'] == 3" class="matchScores">{{ match["score"] }}</span>
                            </div>

                        </div>
                        <div v-for="(matchesOption, key) in match['matchOption']">
                            <div class="team-name-part">
                                <div class="content">
                                    <span class="name badge badge-dark">{{ matchesOption["matchOption"] | capitalizeFirstLetter}}</span>
                                </div>
                            </div>
                            <div class="choice-team-part">
                                <button v-for="(betDetail, key) in matchesOption['betDetails']" value="" :class="[(matchesOption['betDetails'].length == 2) ? 'single-item-for-mobile clickSingleBetDetail' : 'single-item clickSingleBetDetail']" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                    <span >{{ betDetail['betName'] }} &nbsp; <b class="text-primary"> {{ betDetail['betRate'] }}</b> </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="baseball" role="tabpanel" aria-labelledby="baseball-tab">
                <div class="sports_single_category">
                    <h4  class="text-center">
                        <img :src="`backend/uploads/users/volley.png`" alt="image" width="20">
                        Volley
                    </h4>
                    <div v-for="(match, key) in matches[3]">
                        <div class="matchTournamentLiveWrap">
                            <div class="matchTournamentDetailPart">
                                <p>
                                    {{ match["tournamentName"] | capitalizeFirstLetter }}

                                    <span class="badge badge-warning">{{ match["matchDateTime"] | dateformat}}</span>
                                    <span class="badge badge-danger"> {{ match["matchDateTime"] | timeformat}}</span>
                                </p>
                                <p>
                                    {{ match["matchTitle"] }}
                                </p>
                            </div>

                            <div class="matchTournamentLivePart">
                                <span v-if="match['status'] == 3" class="liveNotification"><b class="liveDot"></b>Live</span>
                                <span v-else="match['status'] == 2" class="upcomingNotification">Upcoming</span>
                                <span v-if="match['overs'] != null && match['status'] == 3" class="matchOver"> Overs {{ match["overs"] }} </span>
                                <span v-if="match['status'] == 3" class="matchScores">{{ match["score"] }}</span>
                            </div>

                        </div>
                        <div v-for="(matchesOption, key) in match['matchOption']">
                            <div class="team-name-part">
                                <div class="content">
                                    <span class="name badge badge-dark">{{ matchesOption["matchOption"] | capitalizeFirstLetter}}</span>
                                </div>
                            </div>
                            <div class="choice-team-part">
                                <button v-for="(betDetail, key) in matchesOption['betDetails']" value="" :class="[(matchesOption['betDetails'].length == 2) ? 'single-item-for-mobile clickSingleBetDetail' : 'single-item clickSingleBetDetail']" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                    <span >{{ betDetail['betName'] }} &nbsp; <b class="text-primary"> {{ betDetail['betRate'] }}</b> </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tennis" role="tabpanel" aria-labelledby="tennis-tab">
                <div class="sports_single_category">
                    <h4  class="text-center">
                        <img :src="`backend/uploads/users/tennis.png`" alt="image" width="20">
                        Tennis
                    </h4>
                    <div v-for="(match, key) in matches[4]">
                        <div class="matchTournamentLiveWrap">
                            <div class="matchTournamentDetailPart">
                                <p>
                                    {{ match["tournamentName"] | capitalizeFirstLetter }}

                                    <span class="badge badge-warning">{{ match["matchDateTime"] | dateformat}}</span>
                                    <span class="badge badge-danger"> {{ match["matchDateTime"] | timeformat}}</span>
                                </p>
                                <p>
                                    {{ match["matchTitle"] }}
                                </p>
                            </div>

                            <div class="matchTournamentLivePart">
                                <span v-if="match['status'] == 3" class="liveNotification"><b class="liveDot"></b>Live</span>
                                <span v-else="match['status'] == 2" class="upcomingNotification">Upcoming</span>
                                <span v-if="match['overs'] != null && match['status'] == 3" class="matchOver"> Overs {{ match["overs"] }} </span>
                                <span v-if="match['status'] == 3" class="matchScores">{{ match["score"] }}</span>
                            </div>

                        </div>
                        <div v-for="(matchesOption, key) in match['matchOption']">
                            <div class="team-name-part">
                                <div class="content">
                                    <span class="name badge badge-dark">{{ matchesOption["matchOption"] | capitalizeFirstLetter}}</span>
                                </div>
                            </div>
                            <div class="choice-team-part">
                                <button v-for="(betDetail, key) in matchesOption['betDetails']" value="" :class="[(matchesOption['betDetails'].length == 2) ? 'single-item-for-mobile clickSingleBetDetail' : 'single-item clickSingleBetDetail']" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                    <span >{{ betDetail['betName'] }} &nbsp; <b class="text-primary"> {{ betDetail['betRate'] }}</b> </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="placeBetBtn" aria-hidden="true" aria-labelledby="placeBetBtn" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <button id="customModelClose" @click="closeCustomModel" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="fa fa-close" aria-hidden="true"></span>
                        </button>
                        <h4 style="text-align:center" class="modal-title">Place a bet</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="modalCustomBody">

                                <p v-if="processingMsg" class="text-info text-center" >{{ processingMsg }}</p>
                                <p v-else-if="errorMsg" class="text-danger text-center">{{ errorMsg }}</p>
                                <p v-else-if="successMsg" class="text-success text-center">{{ successMsg }}</p>

                                <p class="text-warning text-center">Minimum Bet Amount {{ config.betMinimum}} & Maximum {{ config.betMaximum}}</p>
                                <div class="modalQusAnsBlock">
                                    <p style="text-transform: capitalize" class="text-secondary" id="betDetailQus">Q: {{ question }}</p>
                                    <p style="text-transform: capitalize" class="text-secondary" id="betDetailAns">A: {{ betDetails.betName}}</p>
                                    <p class="text-secondary">
                                        Bet Rate : <input v-if="betDetails.status != 0" type="text" name="betRate" id="betDetailRate" :value="betDetails.betRate" readonly/>
                                    </p>
                                    <input v-if="betDetails.status != 0" type="number" name="betAmount" v-model="betAmount" id="betAmount" placeholder="0" value="" min="0" @keyup="estimateReturn(betDetails.betRate)"/>
                                    <span class="text-secondary">
                                    Est. Return: <input v-if="betDetails.status != 0" type="text" name="" id="betEstReturn" v-model="estimateResult" value="" readonly/>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div style="display:block;background:#eee" class="modal-footer  text-center">
                            <button v-if="isHidden" class="btn btn-block btn-secondary" id="" :disabled='isDisabled' type="button" name="placeBet" @click="placeBetSubmit(betDetails.id,betDetails.match_id,betDetails.betoption_id,betDetails.betRate)"> Place Bet </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'advanceComponent',
        data() {
            return {
                matches: {},
                config: {},
                betDetails:{},
                question:'',
                betAmount:'',
                estimateResult:'',
                isDisabled:true,
                processingMsg:'',
                errorMsg:'',
                successMsg:'',
                isHidden:true,
                reloadCom:false,
            }
        },
        mounted(){
            this.getMatches();
        },
        created(){
            Echo.channel('betUpdate')
                .listen('betdetailUpdateEvent', (e) => {
                    if(e.message == 1){
                        this.reloadCom = true;
                        this.getMatches();
                        this.reloadCom = false;
                    }
                });
        },
        methods:{
            getMatches() {
                this.$axios.get('/home/menu/advance')
                    .then((response) => {
                        //console.log(response);
                        this.matches = response.data.matches;
                        this.config = response.data.config;
                    }).then((error) => {
                    //console.log(error);
                })
            },
            clickSingleBetDetail(betDetail,question){
                this.betDetails=betDetail;
                this.question=question;

                this.processingMsg = '';
                this.successMsg = '';
                this.errorMsg = '';
            },
            closeCustomModel(){
                this.betAmount = '';
                this.estimateResult = '';
            },
            estimateReturn(betRate){
                this.estimateResult = (betRate*this.betAmount);

                if(this.betAmount < this.config.betMinimum || this.betAmount > this.config.betMaximum){
                    this.isDisabled = true;
                }else{
                    this.isDisabled = false;
                }
            },
            placeBetSubmit(betDetailId,matchId,betOptionId,betRate){
                //console.log(betDetailId,matchId,betOptionId,betRate);
                var form_data = {
                    betDetail_id  : betDetailId,
                    match_id      : matchId,
                    betoption_id  : betOptionId,
                    betDetailRate : betRate,
                    betAmount     : this.betAmount,
                };
                this.processingMsg = 'Bet processing take little time .....';
                this.isHidden = false;
                this.betAmount = '';

                this.$axios.post('/store/place/bet/',form_data)
                    .then((response) => {
                        if(response.data.errorMsg){
                            this.processingMsg = '';
                            this.successMsg = '';
                            this.errorMsg = response.data.errorMsg;
                            this.isHidden = true;
                        }
                        if(response.data.successMsg){
                            this.processingMsg = '';
                            this.errorMsg = '';
                            this.successMsg = response.data.successMsg;
                            this.isHidden = true;
                        }
                    }).then((error) => {
                    if(error){
                        this.processingMsg = '';
                        this.errorMsg = '';
                        this.successMsg = '';
                        this.amount = '';
                        this.errorMsg = 'Something went wrong';
                    }
                })
            }
        }
    }
</script>
