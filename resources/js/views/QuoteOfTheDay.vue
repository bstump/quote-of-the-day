<template>
    <div class="row quote-of-the-day">
        <div class="col mt-5">
            <div class="row">
                <div class="col-sm col-md-6 text-center">
                    <vue-date-picker
                        v-if="date"
                        v-model="date"
                        @onChange="getQuote()"
                        :fullscreen-mobile="true"
                        :no-header="true"
                    >
                        <template #activator="{}" class="test-classs">
                            <button
                                class="btn btn-primary btn-lg mt-3 center-button"
                                ref="activator"
                                type="button"
                            >
                                Quote of the Day
                            </button>
                        </template>
                    </vue-date-picker>
                    <button
                        v-else
                        @click="getQuote('quotd')"
                        class="btn btn-primary btn-lg mt-3"
                        ref="activator"
                        type="button"
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
import { VueDatePicker } from '@mathieustan/vue-datepicker'
import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css'

export default {
    components : {
        VueDatePicker
    },

    data() {
        return {
            loading: false,
            date: null,
            quote: null
        }
    },

    created() {
    },

    methods: {
        getQuote(type = 'quotd') {
            this.loading = true
            this.quote = null
            let current_date = new Date().toISOString().split('T')[0]
            this.date = (type === 'random') ? null : ((this.date) ? this.date : current_date)
            let api_endpoint = (type === 'random') ? '/api/quotes/' + type : '/api/quotes/' + type + '?d=' + this.date

            axios.get(api_endpoint).then(({ data }) => {
                this.quote = data
                this.loading = false
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.center-button {
    margin: 0 auto;
}
</style>
