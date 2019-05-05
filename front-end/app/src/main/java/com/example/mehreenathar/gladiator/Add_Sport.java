package com.example.mehreenathar.gladiator;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class Add_Sport extends AppCompatActivity {
    private EditText newSportNameET;
    private Button addSportBtn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add__sport);

        /******************** References from XML ****************************/
        newSportNameET=(EditText)findViewById(R.id.sportName);
        addSportBtn=(Button)findViewById(R.id.addSportBtn);


        /******************** Register Btn Listener **************************/
        addSportBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });
    }
}
