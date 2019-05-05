package com.example.mehreenathar.gladiator;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class SignUp extends AppCompatActivity {

    private EditText userNameEt;
    private EditText fullNameEt;
    private EditText emailET;
    private EditText passwordET;
    private EditText aboutET;
    private EditText forgetPasswordET;
    private Button signUpBtn;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);

        /****************** References from XML ******************/
        userNameEt=(EditText)findViewById(R.id.userName);
        fullNameEt=(EditText)findViewById(R.id.fullName);
        emailET=(EditText)findViewById(R.id.email);
        passwordET=(EditText)findViewById(R.id.password);
        aboutET=(EditText)findViewById(R.id.about);
        forgetPasswordET=(EditText)findViewById(R.id.forgetPasswordQA);
        signUpBtn=(Button)findViewById(R.id.signUpUser);

        /***************** SignUp Btn Listener *******************/
        signUpBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });
    }
}
