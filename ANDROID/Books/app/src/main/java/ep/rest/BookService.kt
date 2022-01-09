package ep.rest

import retrofit2.Call
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import retrofit2.http.*

object BookService {

    interface RestApi {

        companion object {
            // AVD emulator
            // const val URL = "http://10.0.3.2:8080/netbeans/mvc-rest/api/"
            // Genymotion
            const val URL = "http://10.0.2.2:8080/netbeans/EP-Projekt/api/"
        }

        @GET("store")
        fun getAll(): Call<List<Book>>

        @GET("store/{id}")
        fun get(@Path("id") id: Int): Call<Book>


    }

    val instance: RestApi by lazy {
        val retrofit = Retrofit.Builder()
                .baseUrl(RestApi.URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build()

        retrofit.create(RestApi::class.java)
    }
}
