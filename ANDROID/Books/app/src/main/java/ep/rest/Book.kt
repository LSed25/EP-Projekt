package ep.rest

import java.io.Serializable

data class Book(
        val id: Int = 0,
        val Naslov: String = "",
        val Leto_izdaje: Int = 0,
        val Avtor: String = "",
        val description: String = "",
        val Cena: Double = 0.0) : Serializable
