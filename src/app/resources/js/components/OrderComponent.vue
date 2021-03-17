<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center>
                    <img :src="'/storage/'+rest.avatar" :alt="rest.name" height="120">
                </center>
                <div class="card mt-2">
                    <div class="card-header">
                        {{rest.name}}
                        <span v-show="feed.status!=12" class="badge badge-warning h2 float-right">Prepare</span>
                        <span v-show="feed.status==12" class="badge badge-info h2 float-right">On The Way</span>
                        </div>

                    <div class="card-body lead">
                        <p>
                            {{feed.name}} | {{feed.phone}}
                        </p>
                        <p>
                            {{feed.address }} B:{{feed.aprt}}/D:{{feed.house}} /{{feed.bell}}
                        </p>
                        <h2 class="badge badge-pill badge-dark float-right">{{rest.settings['currency']}}{{feed.total}}</h2>
                        <table v-if="feed.status==12">
                            <tr>
                                <td>
                                    <img :src="'/storage/'+feed.driver.avatar" :alt="feed.driver.name" class="rounded-circle" height="72">
                                </td>
                                <td class="px-2">
                                   {{feed.driver.name}}<br>
                                   {{feed.driver.phone}}
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <div v-if="feed.status==12">
                            <tracking-map :driver="feed.driver"></tracking-map>
                        </div>
                    </div>
                    <div class="card-footer text-center h6">
                        {{rest.name}} <a href="#" data-toggle="modal" data-target="#forwardModal">©</a>
                    </div>
                </div>


            </div>
        </div>
        <div class="modal fade" id="forwardModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORWARD>></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group" v-show="pinMode">
                        <label for="pin" class="col-form-label">PIN:</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" v-model="pin" id="pin">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-outline-success" type="button" @click="checkPin">Apply</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" v-show="!pinMode">
                        <label for="selectDrivers" class="col-form-label">Driver:</label>
                        <select class="form-control" v-model="driver" id="selectDrivers">
                            <option value="0" selected disabled>Select Driver</option>
                            <option v-for="driver in drivers" :key="driver.id" :value="driver.id">{{driver.name}}</option>
                        </select>
                    </div>
                    <div class="alert alert-success" role="alert" v-show="done">
                        Order has been forwarded successfully!
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="forward">FORWARD>> </button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// Parse Here
const Parse = require('parse');
Parse.initialize("cW4zyb70CHc4HfiOhZEd21OqDjnaaMkh2RB2Uamd", "WK1Q0YeZ3rG1m7pYXCRKw2VFOAOuFQokDBCgy4js");
Parse.serverURL = "https://rapidmenu.b4a.io";

var Client = new Parse.LiveQueryClient({
    applicationId: 'cW4zyb70CHc4HfiOhZEd21OqDjnaaMkh2RB2Uamd',
    serverURL: 'wss://' + 'rapidmenu.b4a.io', // Example: 'wss://livequerytutorial.back4app.io'
    javascriptKey: 'WK1Q0YeZ3rG1m7pYXCRKw2VFOAOuFQokDBCgy4js'
});
const query = new Parse.Query("Stream");
query.equalTo("model", "Order");
Client.open();
var subscription = Client.subscribe(query);
    export default {
        props:['order','rest'],
        data() {
            return {
                feed:null,
                pin:null,
                driver:0,
                drivers:[],
                pinMode:true,
                done:false,
            }
        },
        created() {
            this.feed=this.order;
            this.listen();
        },
        methods: {
            checkPin(){
                if(this.rest.settings['pin']==this.pin){
                    this.pinMode=false;
                    axios.get('/api/v1/app/'+this.rest.id+'/drivers').then((res) => {
                        //console.log(res.data);
                        this.drivers=res.data;
                    });
                }

            },
            forward(){
                axios.get('/api/v1/order/rest/select/'+this.driver+'/to/'+this.feed.id).then((res) => {
                        //console.log(res.data);
                        this.done=true;
                        //$('#forwardModal').modal('hide');
                    });
            },
            listen(){
                subscription.on("create", (feedDoc) => {
                    //console.log(feedDoc.attributes);
                    let index = (this.feed.id==feedDoc.attributes.pid);
                    if(index){
                        axios.get('/api/v1/order/get/'+this.order.id).then((res) => {
                        //console.log(res.data);
                        this.feed=res.data;
                    });

                    }

                });
            },
        },
    }
</script>
