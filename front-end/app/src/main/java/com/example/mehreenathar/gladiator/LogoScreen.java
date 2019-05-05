package com.example.mehreenathar.gladiator;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class LogoScreen extends AppCompatActivity {

    TextView appName;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_logo_screen);

        appName=(TextView)findViewById(R.id.appName);
        //on name click listener
        appName.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                redirectToLoginPage();
            }
        });
    }
    public void redirectToLoginPage()
    {

        Intent redirectToLogin=new Intent(LogoScreen.this,Login.class);
        startActivity(redirectToLogin);
    }
}
