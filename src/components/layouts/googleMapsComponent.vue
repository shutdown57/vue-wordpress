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
    },

    mounted() {
        this.$refs.map.$mapCreated.then(res => {
            this.mapLoaded = true;
            google.maps.event.trigger(this.$refs.map, 'resize');
            this.$refs.map.resize();
            this.$refs.map.resizePreserveCenter();
        }, rej => { console.log(rej); });
    }
}
</script>

<style>
#map {
    width: 100%;
    height: 300px;
}
</style>
