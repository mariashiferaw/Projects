import java.io.*;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.Map;
import java.util.Scanner;
import java.util.regex.Pattern;
import java.util.regex.Matcher;

public class main 
{
	public static void main(String[] args) throws IOException{
		// TODO Auto-generated method stub
		
		String searchword ="";
		Scanner keyboard = new Scanner(System.in);
		
		System.out.println("Enter the search word: ");
		searchword = keyboard.nextLine().trim().toLowerCase(); 
		
		readFile(searchword);
}

public static void readFile(String searchword) throws IOException
{
	//String text = "";
	File fileOne = null;
	File fileTwo = null;
	File fileThree = null;
	File fileFour = null;
	File fileFive = null;
	
	String[] filenames = {"articleLorelei.txt", "articleMaria.txt", 
			"articleMorgan.txt", "articlePaula.txt", "articleLoreleiTwo.txt"};
	
	ArrayList<String> allWordsOne= new ArrayList<String>();
	ArrayList<String> allWordsTwo= new ArrayList<String>();
	ArrayList<String> allWordsThree= new ArrayList<String>();
	ArrayList<String> allWordsFour= new ArrayList<String>();
	ArrayList<String> allWordsFive= new ArrayList<String>();
	
	ArrayList<String> allParagraphOne= new ArrayList<String>();
	ArrayList<String> allParagraphTwo= new ArrayList<String>();
	ArrayList<String> allParagraphThree= new ArrayList<String>();
	ArrayList<String> allParagraphFour= new ArrayList<String>();
	ArrayList<String> allParagraphFive= new ArrayList<String>();
	
	fileOne = new File(filenames[0]);
	Scanner inputFileOne = new Scanner(fileOne);
	
	// read in the file 
	int lineNumberOne = 0;
	while (inputFileOne.hasNextLine()) {
		String line = inputFileOne.nextLine();
		// add all paragraphs into the ArrayList
		allParagraphOne.add(line);
		
		for (String word : line.split("\\s")) {
			word = word.replaceAll("[^a-zA-Z0-9]","");
			if (!word.isEmpty())
				//System.out.println(word);
				allWordsOne.add(word);
		}
		lineNumberOne++;
	}
	
	fileTwo = new File(filenames[1]);
	Scanner inputFileTwo = new Scanner(fileTwo);
	
	// read in the file 
	int lineNumberTwo = 0;
	while (inputFileTwo.hasNextLine()) {
		String line = inputFileTwo.nextLine();
		// add all paragraphs into the ArrayList
		allParagraphTwo.add(line);
		
		for (String word : line.split("\\s")) {
			word = word.replaceAll("[^a-zA-Z0-9]","");
			if (!word.isEmpty())
				//System.out.println(word);
				allWordsTwo.add(word);
		}
		lineNumberTwo++;
	}
	
	fileThree = new File(filenames[2]);
	Scanner inputFileThree = new Scanner(fileThree);
	
	// read in the file 
	int lineNumberThree = 0;
	while (inputFileThree.hasNextLine()) {
		String line = inputFileThree.nextLine();
		// add all paragraphs into the ArrayList
		allParagraphThree.add(line);
				
		for (String word : line.split("\\s")) {
			word = word.replaceAll("[^a-zA-Z0-9]","");
			if (!word.isEmpty())
				//System.out.println(word);
				allWordsThree.add(word);
		}
		lineNumberThree++;
	}

	fileFour = new File(filenames[3]);
	Scanner inputFileFour = new Scanner(fileFour);
	
	// read in the file 
	int lineNumberFour = 0;
	while (inputFileFour.hasNextLine()) {
		String line = inputFileFour.nextLine();
		// add all paragraphs into the ArrayList
		allParagraphFour.add(line);
				

		for (String word : line.split("\\s")) {
			word = word.replaceAll("[^a-zA-Z0-9]","");
			if (!word.isEmpty())
				//System.out.println(word);
				allWordsFour.add(word);
		}
		lineNumberFour++;
	}
	
	fileFive = new File(filenames[4]);
	Scanner inputFileFive = new Scanner(fileFive);
	
	// read in the file 
	int lineNumberFive = 0;
	while (inputFileFive.hasNextLine()) {
		String line = inputFileFive.nextLine();
		// add all paragraphs into the ArrayList
		allParagraphFive.add(line);
				

		for (String word : line.split("\\s")) {
			word = word.replaceAll("[^a-zA-Z0-9]","");
			if (!word.isEmpty())
				//System.out.println(word);
				allWordsFive.add(word);
		}
		lineNumberFive++;
	}
	
	indexer(allWordsOne, allWordsTwo, allWordsThree, allWordsFour, allWordsFive, allParagraphOne, allParagraphTwo, allParagraphThree, allParagraphFour,
			allParagraphFive, searchword);
	
	/*for (int i = 0; i < allParagraphTwo.size(); i++)
	{
		System.out.println(i + ": " + allParagraphTwo.get(i));
	}*/
	
}

public static void indexer(ArrayList<String> allWords1, ArrayList<String> allWords2, ArrayList<String> allWords3, ArrayList<String> allWords4,ArrayList<String> allWords5, 
		ArrayList<String> allParagraphOne, ArrayList<String> allParagraphTwo, ArrayList<String> allParagraphThree, ArrayList<String> allParagraphFour, ArrayList<String> allParagraphFive,String word) {

	ArrayList<Paragraphs> summaryList= new ArrayList<Paragraphs>();
	
	HashMap<String, Integer> indexOne = new HashMap();
	for(int i = 0; i < allWords1.size(); i++)
	{
		String s = allWords1.get(i).toLowerCase();
		if(indexOne.containsKey(s)) {
			indexOne.put(s, indexOne.get(s) + 1);
		}
		else {
			indexOne.put(s, 1);
		}
		
	}
	if (indexOne.containsKey(word) == true) {
		System.out.println("\"Can Technology Improve Health Care Decisions?\"," + indexOne.get(word) + " times.");
		hitlist(allParagraphOne, word, summaryList);
	}
	
	
	HashMap<String, Integer> indexTwo = new HashMap();
	for(int i = 0; i < allWords2.size(); i++)
	{
		// maybe change 's' to different letter
		String s = allWords2.get(i).toLowerCase();
		if(indexTwo.containsKey(s)) {
			indexTwo.put(s, indexTwo.get(s) + 1);
		}
		else {
			indexTwo.put(s, 1);
		}
		
	}
	if (indexTwo.containsKey(word) == true) {
		System.out.println("\"Technology and the Future of Healthcare\", " + indexTwo.get(word) + " times.");
		hitlist(allParagraphTwo, word,summaryList);
	}
	
	HashMap<String, Integer> indexThree = new HashMap();
	for(int i = 0; i < allWords3.size(); i++)
	{
		String s = allWords3.get(i).toLowerCase();
		if(indexThree.containsKey(s)){
		//if(indexThree.get(i).equalsIgnoreCase(s)) {
			indexThree.put(s, indexThree.get(s) + 1);
		}
		else {
			indexThree.put(s, 1);
		}
		
	}
	if (indexThree.containsKey(word) == true) {
		System.out.println("\"Overview of artificial intelligence in medicine\", " + indexThree.get(word) + " times.");
		hitlist(allParagraphThree, word, summaryList);
	}
	
	HashMap<String, Integer> indexFour = new HashMap();
	for(int i = 0; i < allWords4.size(); i++)
	{
		String s = allWords4.get(i).toLowerCase();
		if(indexFour.containsKey(s)) {
			indexFour.put(s, indexFour.get(s) + 1);
		}
		else {
			indexFour.put(s, 1);
		}
		
	}
	if (indexFour.containsKey(word) == true) {
		System.out.println("\"Research Trends in Teens’ Health Information Behaviour: A Review of the Literature.\", " + indexFour.get(word) + " times.");
		hitlist(allParagraphFour, word,summaryList);
	}
	
	HashMap<String, Integer> indexFive = new HashMap();
	for(int i = 0; i < allWords5.size(); i++)
	{
		String s = allWords5.get(i).toLowerCase();
		if(indexFive.containsKey(s)) {
			indexFive.put(s, indexFive.get(s) + 1);
		}
		else {
			indexFive.put(s, 1);
		}
		
	}
	if (indexFive.containsKey(word) == true) {
		System.out.println("\"EVALUATION OF NEW TECHNOLOGIES BY HOSPITALS AND OTHER HEALTHCARE PROVIDERS: ISSUES TO CONSIDER.\", " + indexFive.get(word) + " times.");
		hitlist(allParagraphFive, word,summaryList);
	}

	if (indexOne.get(word) == null && indexTwo.get(word) == null && indexThree.get(word) == null && indexFour.get(word) == null && indexFive.get(word) == null ) 
	{ 
		System.out.println(word + " wasn’t found"); 
	}
	
	sorting(summaryList);
}

public static void hitlist(ArrayList<String> allParagraphs, String searchword, ArrayList<Paragraphs> summaryList) {
	
	for(int i = 0; i < allParagraphs.size(); i++)
	{
		Matcher matcher = Pattern.compile("(?i)\\b" + Pattern.quote(searchword) + "\\b").matcher(allParagraphs.get(i));
		if (matcher.find())
		{ 
			int index = i+1;
			String newParagraphs = allParagraphs.get(i).replaceAll("[^a-zA-Z0-9]"," ");
			parIndex(newParagraphs,searchword, index, summaryList);
		}
	}
}

public static void parIndex(String theParagraphs, String searchword, Integer index, ArrayList<Paragraphs> summaryList ) {
	int counter = 0; 
	String word[] = theParagraphs.split(" ");
	
	for (int i = 0; i < word.length; i++)
	{
		if (word[i].equalsIgnoreCase(searchword))
		{
			counter++;
		}
	}
	
	String sumString = index+ " " +theParagraphs;
	Paragraphs para = new Paragraphs(sumString, counter);
	summaryList.add(para); // add each Paragraphs class to the ArrayList
}

public static void sorting(ArrayList<Paragraphs> summaryList)
{
	for(int i = 0; i < summaryList.size()-1; i ++)
	{
		for(int j = 0; j < summaryList.size()-1-i; j ++)
		{
			if (summaryList.get(j).getcount() < summaryList.get(j+1).getcount())
			{
				Collections.swap(summaryList, j, j+1);
			}
		}
	}
	
	System.out.println(" ");
	for(int i = 0; i < summaryList.size()-1; i ++)
	{
		System.out.println(summaryList.get(i).getpara());
	}
}
}
