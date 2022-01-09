package ep.rest

import android.os.Bundle
import android.util.Log
import androidx.appcompat.app.AppCompatActivity
import ep.rest.databinding.ActivityBookDetailBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import java.io.IOException

class BookDetailActivity : AppCompatActivity() {
    private var book: Book = Book()
    val binding by lazy {
        ActivityBookDetailBinding.inflate(layoutInflater)
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(binding.root)
        setSupportActionBar(binding.toolbar)


        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val id = intent.getIntExtra("ep.rest.id", 0)

        if (id > 0) {
            BookService.instance.get(id).enqueue(OnLoadCallbacks(this))
        }
    }


    private class OnLoadCallbacks(val activity: BookDetailActivity) : Callback<Book> {
        private val tag = this::class.java.canonicalName

        override fun onResponse(call: Call<Book>, response: Response<Book>) {
            activity.book = response.body() ?: Book()

            Log.i(tag, "Got result: ${activity.book}")

            if (response.isSuccessful) {
                activity.binding.includer.tvBookDetail.text = activity.book.Naslov
                activity.binding.toolbarLayout.title = activity.book.Avtor
            } else {
                val errorMessage = try {
                    "An error occurred: ${response.errorBody()?.string()}"
                } catch (e: IOException) {
                    "An error occurred: error while decoding the error message."
                }

                Log.e(tag, errorMessage)
                activity.binding.includer.tvBookDetail.text = errorMessage
            }
        }

        override fun onFailure(call: Call<Book>, t: Throwable) {
            Log.w(tag, "Error: ${t.message}", t)
        }
    }
}

