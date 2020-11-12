import axios from 'axios'
import { reject } from 'lodash'
import { createStore } from 'vuex'


const state = {
    token: localStorage.getItem('access_token') || null,
    count: 0
}
const getters = {
    loggedIn(state) {
        return state.token != null
    }
}
const mutations = {
    increment(state) {
        state.count++
    },
    decrement(state) {
        state.count--
    },
    retrieveToken(state, token) {
        state.token = token
    },
    destroyToken(state) {
        state.token = null
    }
}

const actions = {
    destroyToken(context){

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

        if(context.getters.loggedIn){
            return new Promise((resolve, reject) => {
                axios.post('api/logout')
                    .then(response =>  {
        
                        localStorage.removeItem('access_token')
                        context.commit('destroyToken')
                        resolve(response)

                    })
                    .catch(error => {
                            localStorage.removeItem('access_token')
                            context.commit('destroyToken')
                            reject(error)
                        })
            }) 
        }
    },

    retrieveToken(context, credentials) {

        return new Promise((resolve, reject) => {
            axios.post('api/login', {
                username: credentials.username,
                password: credentials.password,
            })
                .then(response =>  {
                    const token = response.data.access_token
    
                    localStorage.setItem('access_token', token)
                    context.commit('retrieveToken', token)
                    resolve(response)
                })
                .catch(error => {
                        console.log(error)
                        reject(error)
                    })
        })
        
        
    }
    
}

export default createStore({
    state,
    getters,
    mutations,
    actions
})