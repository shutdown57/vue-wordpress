<template>
    <div>
        <gmap-map ref="map"
                :center="position"
                @center_changed="updateCenter"
                v-show="mapLoaded"
                :zoom="16"
                map-type-id="roadmap"
                style="width: 100%; height: 200px"
                >
            <gmap-marker
                    :position="position_"
                    :clickable="false"
                    :draggable="false"
                    :title="'شرکت ایرانیان مگنت'"
                    ></gmap-marker>
        </gmap-map>
        <!-- <div id="map"></div> -->
    </div>
</template>

<script>
/**
 * @component: Google Maps
 */


export default {
    name: 'googleMaps',

    data() {
        return {
            position: { lat: 35.7012317, lng: 51.4443317 },
            position_: { lat: 35.7012361, lng: 51.4443103 },
            map: null,
            mapName: 'map',
            bounds: null,
            mapLoaded: true
        };
    },

    methods: {
        updateCenter(center) {
            this.position = { lat: center.lat, lng: center.lng };
        }
        // initMap() {
        //     this.map = new google.maps.Map(document.getElementById('map'), {
        //         center: { lat: 35.7012317, lng: 51.4443317 },
        //         zoom: 16,
        //         disableDefaultUI: true
        //     });
        // }
    },

    mounted() {
        // setTimeout(() => {
        //     this.$refs.map.$mapCreated.then(res => {
        //         // console.log(res);
        //         this.mapLoaded = true;
        //     }, rej => { console.log(rej); });
        // }, 5000);
        // this.initMap();
        // this.$refs.map.$mapCreated.then(res => {
        //     // console.log(res);
        //     this.mapLoaded = true;
        // }, rej => { console.log(rej); });
        this.$refs.map.$mapCreated.then(res => {
            // console.log(this.$refs.map);
            this.mapLoaded = true;
            // google.maps.event.addListenerOnce(this.$refs.map, 'idle', function(){
            //     google.maps.event.trigger(this.$refs.map, 'resize');
            //     this.$refs.map.checkResize();
            //     this.$refs.map.setCenter(this.position);
            //     this.$refs.map.setZoom( this.$refs.map.getZoom() );
            //     console.log("OK");
            // });
            google.maps.event.trigger(this.$refs.map, 'resize');
            // this.$refs.map.checkResize();
            // this.$refs.map.setCenter(this.position);
            // this.$refs.map.setZoom( this.$refs.map.getZoom() );
            this.$refs.map.resize();
            this.$refs.map.resizePreserveCenter();
        }, rej => { console.log(rej); });
    },

    updated() {
        // setInterval(() => {
        //     this.$refs.map.$mapCreated.then(res => {
        //         // console.log(res);
        //         this.mapLoaded = true;
        //         google.maps.event.addListenerOnce(this.$refs.map, 'idle', function(){
        //             google.maps.event.trigger(this.$refs.map, 'resize');
        //             this.$refs.map.checkResize();
        //             this.$refs.map.setCenter(this.position);
        //             this.$refs.map.setZoom( this.$refs.map.getZoom() );
        //             console.log("OK");
        //         });
        //     }, rej => { console.log(rej); });
        // }, 2000);
        // setTimeout(() => {
        //     // this.$refs.map.resizePreserveCenter(this.position);
        //     google.maps.event.addListenerOnce(this.$refs.map, 'idle', function(){
        //         google.maps.event.trigger(this.$refs.map, 'resize');
        //         this.$refs.map.checkResize();
        //         // this.$refs.map.setCenter(this.position);
        //         this.$refs.map.setZoom( this.$refs.map.getZoom() );
        //     });
        // }, 2000);
    }
}
</script>

<style>
#map {
    width: 100%;
    height: 300px;
}
</style>
