package com.example.mehreenathar.gladiator;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class Login extends AppCompatActivity {

    private TextView notUser;
    private EditText userNameET;
    private EditText passwordET;
    private Button loginBtn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        /*************** references from XML **************************/
        notUser=(TextView)findViewById(R.id.notUser);
        userNameET=(EditText)findViewById(R.id.userName);
        passwordET=(EditText)findViewById(R.id.password);
        loginBtn=(Button)findViewById(R.id.loginUser);

        /************ not a user textview event listener   *************/
        notUser.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                redirectToSignPage();
            }
        });

        /****************** Login Btn Listener ************************/

    }
    public void redirectToSignPage()
    {

        Intent redirectToLogin=new Intent(Login.this,SignUp.class);
        startActivity(redirectToLogin);
    }
}
