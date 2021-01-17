<template>
    <div class="row">
        <div class="col mt-5">
            <div class="row">
                <div class="col-sm col-md-6 text-center">
                    <button
                        @click="getQuote()"
                        type="button"
                        class="btn btn-primary btn-lg mt-3"
                        :disabled="is_quotd"
                    >
                        Quote of the Day
                    </button>
                </div>
                <div class="col-sm col-md-6 text-center">
                    <button
                        @click="getQuote('random')"
                        type="button"
                        class="btn btn-primary btn-lg mt-3"
                    >
                        Random Quote
                    </button>
                </div>
            </div>
            <div
                v-if="!loading && quote"
                class="row mt-5"
            >
                <div class="col-sm-12 col-md-6 offset-md-3 mt-5">
                    <blockquote class="blockquote">
                        <p>
                            {{ quote.text }}
                        </p>
                        <footer class="blockquote-footer">
                            {{ (quote.author && quote.author.trim() !== '') ? quote.author : 'Unknown' }}
                        </footer>
                    </blockquote>
                </div>
            </div>
            <div
                v-else
                class="row mt-5"
            >
                <div
                    v-if="loading"
                    class="col text-center"
                >
                    <em>
                        Loading...
                    </em>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            quote: null,
            is_quotd: false
        }
    },

    created() {
    },

    methods: {
        getQuote(type = 'quotd') {
            this.quote = null
            this.loading = true
            this.is_quotd = (type === 'quotd') ? true : false
            axios.get('/api/quotes/' + type).then(({ data }) => {
                this.quote = data
                this.loading = false
            })
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
