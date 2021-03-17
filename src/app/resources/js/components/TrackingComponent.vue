<template>
    <div>
     <GmapMap
        :center="{lat:marker.position.lat, lng:marker.position.lng}"
        :zoom="16"
        scaleControl='false'
        style="width: 100%; height: 300px" >
        <GmapMarker
                :clickable="true"
                :name="marker.name"
                :icon="marker.icon"
                :position="marker.position" >

              </GmapMarker>
        </GmapMap>
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



export default {
    name: "TrackingMap",
    props:['driver'],
    data() {
        return {
            //feed:null,
            marker:{
                id:0,
                name:'-',
                icon:'/images/car-active.png',
                position:{lat:0,lng:0}
            }
        }
    },
    created() {
        this.listen();
        //this.feed=this.driver;
        this.track(this.driver);



    },
    methods: {
        track(driver){
            this.marker.position.lat=driver.lat;
            this.marker.position.lng=driver.lng;
            this.marker.id=driver.id;
            this.marker.name=driver.name;

        },
        listen(){
            const query = new Parse.Query("Stream");
            query.equalTo("model", "Driver");
            query.equalTo("meta.hash", this.driver.hash);
            Client.open();
            var subscription = Client.subscribe(query);
                subscription.on("create", (feedDoc) => {
                    axios.get( '/api/v1/fetch/driver/' + feedDoc.attributes.pid)
                        .then((res) => {
                            if(res.data.lat){
                                this.track(res.data);
                            }
                            //this.feed=res.data;
                        });
                });
        },
    },

}
</script>
