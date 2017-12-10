<template>
    <div>
        <gmap-map v-if="mapLoaded"
                ref="map"
                :center="position"
                :zoom="17"
                map-type-id="terrain"
                style="width: 500px; height: 300px"
                >
        </gmap-map>
    </div>
</template>

<script>
/**
 * @component: Google Maps
 */
import {GMAPS_OPT} from '../../config';


export default {
    name: 'googleMaps',

    data() {
        return {
            position: { lat: 35.7012382, lng: 51.4432159 },
            map: null,
            mapName: 'map',
            bounds: null,
            mapLoaded: false
        };
    },

    mounted() {
        // this.initMap();
        this.map = this.$refs.map.$mapObject;
        this.$refs.map.$mapCreated.then(() => this.mapLoaded = true );
    },

    // methods: {
    //     initMap() {
    //         this.bounds = new google.maps.LatLngBounds();
    //         const element = document.getElementById(this.mapName);
    //         const mapCenter = {...this.position};
    //         const options = {
    //             center: new google.maps.LatLng(mapCenter.lat, mapCenter.lng)
    //         };
    //         this.map = new google.maps.Map(element, options);
    //         const position_ = new google.maps.LatLng(this.position.lat, this.position.lng);

    //         const marker = new google.maps.Marker({
    //             position_,
    //             map: this.map
    //         });

    //         this.map.fitBounds(this.bounds.extends(position_));
    //     }
    // }
}
</script>

<style>
#map {
    width: 200px;
    height: 200px;
}
</style>
