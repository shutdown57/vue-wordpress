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
            position: { lat: 35.7012317, lng: 51.4443317 },
            position_: { lat: 35.7012361, lng: 51.4443103 },
            map: null,
            mapName: 'map',
            bounds: null,
            mapLoaded: false
        };
    },

    methods: {
        updateCenter(center) {
            this.position = { lat: center.lat, lng: center.lng };
        }
        // loadMap() {
        //     // this.mapLoaded = true;
        //     this.map.$mapCreated.then(res => {
        //         // console.log(res);
        //         this.mapLoaded = true;
        //     }, rej => { console.log(rej); });
        // }
    },

    mounted() {
        setTimeout(() => {
            this.$refs.map.$mapCreated.then(res => {
                // console.log(res);
                this.mapLoaded = true;
            }, rej => { console.log(rej); });
        }, 5000);
        
        // console.log(this.$refs.map.resizePreserveCenter());
    },

    updated() {
        this.$refs.map.resizePreserveCenter(this.position);
    }
}
</script>

<style>
#map {
    width: 200px;
    height: 200px;
}
</style>
