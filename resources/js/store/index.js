import axios from 'axios'
import { createStore } from 'vuex'
import { AuthModule } from './auth'


const state = {
    count: 0,
}
const getters = {

}
const mutations = {
    increment(state) {
        state.count++
    },
    decrement(state) {
        state.count--
    },
}

const actions = {



}

const modules = {
    Auth: AuthModule
}

export default createStore({
    state,
    getters,
    mutations,
    actions,
    modules
})
