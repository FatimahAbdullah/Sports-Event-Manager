package com.example.mehreenathar.gladiator;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;

public class Add_Sport_Club extends AppCompatActivity {

    private EditText clubNameET;
    private EditText clubDescriptionET;
    private Spinner sportClubSpinner;
    private Button registerClub;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add__sport__club);

        /******************* References from XML *********************/
        clubNameET=(EditText)findViewById(R.id.clubName);
        clubDescriptionET=(EditText)findViewById(R.id.description);
        sportClubSpinner=(Spinner)findViewById(R.id.sportClubSpinner);
        registerClub=(Button)findViewById(R.id.registerClub);


        /************ use spinner setup from previous activity here *************/
    }
}
