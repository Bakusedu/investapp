<template>
    <div>
        <h1>Hy iB AHJSAS ASH SA </h1>
    </div>
</template>

<script>

    export default {
        props: ['data'], // accepts data for replies

        components: {Reply},

        data() {
            return {
                items: this.data
            }
        }
    }
</script>
