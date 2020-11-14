import axios from 'axios'
import { attempt, reject } from 'lodash'
import { createStore } from 'vuex'


const state = {
    token: localStorage.getItem('access_token') || null,
    user: null,
    count: 0
}
const getters = {
    loggedIn(state) {
        return state.token != null
    },
    authUser(state) {
        return state.user
    },
}
const mutations = {
    increment(state) {
        state.count++
    },
    decrement(state) {
        state.count--
    },
    SET_TOKEN(state, token) {
        state.token = token
    },
    destroyToken(state) {
        state.token = null
        state.user = null
    },
    retrieveLogedinUser(state, data) {
        state.user = data
    }
}

const actions = {
    register(context, data) {

        return new Promise((resolve, reject) => {
            axios.post('api/register', {
                username: data.username,
                name: data.name,
                email: data.email,
                password: data.password,
            })
                .then(response =>  {
                    
                    resolve(response)
                })
                .catch(error => {
                        reject(error)
                    })
        })

    },
    
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

    async retrieveToken ({ dispatch }, credentials) {
        let response = await axios.post('api/login', {
            username: credentials.username,
            password: credentials.password,
        })
        localStorage.setItem('access_token', response.data.access_token)
        dispatch('attempt', response.data.access_token)
    },

    async attempt ({ commit }, token) {
        commit('SET_TOKEN', token)

        try {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            let response = await axios.get(`/api/logedinUser`)
            
            commit('retrieveLogedinUser', response.data.data)
        } catch (e) {
            //
        }
    }

    // retrieveToken(context, credentials) {

    //     return new Promise((resolve, reject) => {
    //         axios.post('api/login', {
    //             username: credentials.username,
    //             password: credentials.password,
    //         })
    //             .then(response =>  {
    //                 const token = response.data.access_token
    //                 // console.log(response.data)
    //                 localStorage.setItem('access_token', token)
    //                 context.dispatch('attempt', token)
                    
    //                 resolve(response)
    //             })
    //             .catch(error => {
    //                     reject(error)
    //                 })
    //     })
        
        
    // },

    // async attempt(context, token) {
    //     context.commit('retrieveToken', token)

    //     try {
    //         axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
    //         let response = await axios.get(`/api/logedinUser`)
            
    //         context.commit('retrieveLogedinUser', response.data)
    //     } catch (e) {
    //         //
    //     }
    // }
    
}

export default createStore({
    state,
    getters,
    mutations,
    actions
})